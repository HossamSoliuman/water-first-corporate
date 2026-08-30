<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class PageController extends Controller
{
    /**
     * What each page exposes to the admin. Anything not listed here keeps its
     * copy in the site content seeder and edits only its SEO meta.
     *
     *  - `content` — title, subtitle and the raw HTML body.
     *  - `header`  — title and subtitle only (the body is composed of sections).
     *  - `intro`   — the two-column intro block (copy left, image right).
     *  - `blocks`  — the repeatable section blocks listed in self::REPEATERS.
     *  - `cards`   — the page's card collection (managed by PageCardController).
     *
     * @var array<string, list<string>>
     */
    private const ABILITIES = [
        'privacy-policy' => ['content'],
        'terms-conditions' => ['content'],
        'our-team' => ['intro'],
        'business-models' => ['header', 'intro', 'blocks', 'cards'],
    ];

    /**
     * Repeatable blocks stored in the page's `sections` payload, mapped to the
     * fields each row carries. The second field is the row's anchor: rows that
     * leave it blank are dropped on save.
     *
     * @var array<string, list<string>>
     */
    public const REPEATERS = [
        'hero_chips' => ['icon', 'label'],
        'highlights' => ['icon', 'label', 'detail'],
        'benefits' => ['icon', 'label', 'detail'],
        'stages' => ['icon', 'title', 'detail'],
    ];

    /**
     * Single-line section copy stored alongside the repeaters.
     *
     * @var list<string>
     */
    public const BLOCK_FIELDS = [
        'cards_heading', 'cards_body',
        'benefits_heading', 'benefits_body', 'benefits_footnote',
        'stages_heading', 'stages_body', 'stages_cta',
        'closing_heading', 'closing_body',
    ];

    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $pages = Page::orderBy('id')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $page->load('seo', 'cards');

        return view('admin.pages.edit', [
            'page' => $page,
            'canEditContent' => $this->can($page, 'content'),
            'canEditHeader' => $this->can($page, 'header'),
            'canEditIntro' => $this->can($page, 'intro'),
            'canEditBlocks' => $this->can($page, 'blocks'),
            'canEditCards' => $this->can($page, 'cards'),
        ]);
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate($this->rules($page));

        if ($this->can($page, 'content') || $this->can($page, 'header')) {
            $attributes = [
                'title' => $validated['title'],
                'subtitle' => $validated['subtitle'] ?? null,
                'is_published' => $request->boolean('is_published'),
            ];

            if ($this->can($page, 'content')) {
                $attributes['content'] = $validated['content'] ?? null;
            }

            $page->update($attributes);
        }

        if ($this->can($page, 'intro') || $this->can($page, 'blocks')) {
            $this->saveSections($request, $page, $validated);
        }

        $this->seoService->saveFor($page, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));

        return back()->with('success', 'Page updated successfully.');
    }

    /**
     * @return array<string, mixed>
     */
    private function rules(Page $page): array
    {
        $rules = [
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:255',
            'robots' => ['nullable', Rule::in(['index,follow', 'noindex,follow', 'index,nofollow', 'noindex,nofollow'])],
        ];

        if ($this->can($page, 'content') || $this->can($page, 'header')) {
            $rules += [
                'title' => 'required|string|max:200',
                'subtitle' => 'nullable|string|max:300',
            ];
        }

        if ($this->can($page, 'content')) {
            $rules['content'] = 'nullable|string';
        }

        if ($this->can($page, 'intro')) {
            $rules += [
                'intro_label' => 'nullable|string|max:120',
                'intro_heading' => 'nullable|string|max:200',
                'intro_body' => 'nullable|string|max:5000',
                'side_image' => 'nullable|image|max:4096',
            ];
        }

        if ($this->can($page, 'blocks')) {
            foreach (self::BLOCK_FIELDS as $field) {
                $rules[$field] = 'nullable|string|max:600';
            }

            foreach (self::REPEATERS as $block => $fields) {
                $rules[$block] = 'nullable|array|max:12';

                foreach ($fields as $field) {
                    $rules["{$block}.*.{$field}"] = $field === 'detail'
                        ? 'nullable|string|max:600'
                        : 'nullable|string|max:150';
                }
            }
        }

        return $rules;
    }

    /**
     * Persist the intro copy, its side image and the repeatable blocks into
     * `sections`, leaving every other key in the payload untouched.
     *
     * @param  array<string, mixed>  $validated
     */
    private function saveSections(Request $request, Page $page, array $validated): void
    {
        $sections = $page->sections ?? [];

        if ($this->can($page, 'intro')) {
            $sections['intro_label'] = $validated['intro_label'] ?? null;
            $sections['intro_heading'] = $validated['intro_heading'] ?? null;
            $sections['intro_body'] = $validated['intro_body'] ?? null;

            $previousImage = $sections['side_image'] ?? null;

            if ($request->hasFile('side_image')) {
                $sections['side_image'] = $this->storeSideImage($request->file('side_image'));
                $this->deleteImage($previousImage);
            } elseif ($request->boolean('remove_side_image')) {
                $this->deleteImage($previousImage);
                $sections['side_image'] = null;
            }
        }

        if ($this->can($page, 'blocks')) {
            foreach (self::BLOCK_FIELDS as $field) {
                $sections[$field] = $validated[$field] ?? null;
            }

            foreach (self::REPEATERS as $block => $fields) {
                $sections[$block] = $this->compactRows($validated[$block] ?? [], $fields);
            }
        }

        $page->update(['sections' => array_filter($sections, fn ($value) => $value !== null)]);
    }

    /**
     * Drop rows whose anchor field is blank and trim what survives.
     *
     * @param  array<int, array<string, string|null>>  $rows
     * @param  list<string>  $fields
     * @return list<array<string, string>>
     */
    private function compactRows(array $rows, array $fields): array
    {
        $anchor = $fields[1];

        return collect($rows)
            ->map(fn ($row): array => collect($fields)
                ->mapWithKeys(fn (string $field): array => [$field => trim((string) ($row[$field] ?? ''))])
                ->all())
            ->filter(fn (array $row): bool => $row[$anchor] !== '')
            ->values()
            ->all();
    }

    private function storeSideImage(UploadedFile $file): string
    {
        $dir = public_path('pages');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'pages/'.$filename;
    }

    private function deleteImage(?string $path): void
    {
        if ($path && file_exists(public_path($path))) {
            @unlink(public_path($path));
        }
    }

    private function can(Page $page, string $ability): bool
    {
        return in_array($ability, self::ABILITIES[$page->slug] ?? [], true);
    }
}

// ──────────────────────────────────────────────────────────────
// LeadController (Admin)
// ──────────────────────────────────────────────────────────────
