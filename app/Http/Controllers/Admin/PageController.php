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
     * Pages whose copy is editable from the admin. Every other page keeps its
     * copy in the site content seeder and exposes only its SEO meta here.
     *
     * @var list<string>
     */
    private const CONTENT_EDITABLE_SLUGS = ['privacy-policy', 'terms-conditions'];

    /**
     * Pages whose two-column intro section (copy left, image right) is editable
     * from the admin. The values live in the page's `sections` payload.
     *
     * @var list<string>
     */
    private const INTRO_EDITABLE_SLUGS = ['our-team'];

    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $pages = Page::orderBy('id')->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $page->load('seo');
        $canEditContent = $this->canEditContent($page);
        $canEditIntro = $this->canEditIntro($page);

        return view('admin.pages.edit', compact('page', 'canEditContent', 'canEditIntro'));
    }

    public function update(Request $request, Page $page)
    {
        $rules = [
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'og_image' => 'nullable|string|max:255',
            'robots' => ['nullable', Rule::in(['index,follow', 'noindex,follow', 'index,nofollow', 'noindex,nofollow'])],
        ];

        if ($this->canEditContent($page)) {
            $rules += [
                'title' => 'required|string|max:200',
                'subtitle' => 'nullable|string|max:300',
                'content' => 'nullable|string',
            ];
        }

        if ($this->canEditIntro($page)) {
            $rules += [
                'intro_label' => 'nullable|string|max:120',
                'intro_heading' => 'nullable|string|max:200',
                'intro_body' => 'nullable|string|max:5000',
                'side_image' => 'nullable|image|max:4096',
            ];
        }

        $validated = $request->validate($rules);

        if ($this->canEditContent($page)) {
            $page->update([
                'title' => $validated['title'],
                'subtitle' => $validated['subtitle'] ?? null,
                'content' => $validated['content'] ?? null,
                'is_published' => $request->boolean('is_published'),
            ]);
        }

        if ($this->canEditIntro($page)) {
            $this->saveIntroSection($request, $page, $validated);
        }

        $this->seoService->saveFor($page, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));

        return back()->with('success', 'Page updated successfully.');
    }

    /**
     * Persist the two-column intro copy and its side image into `sections`,
     * leaving every other key in the payload untouched.
     *
     * @param  array<string, mixed>  $validated
     */
    private function saveIntroSection(Request $request, Page $page, array $validated): void
    {
        $sections = $page->sections ?? [];

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

        $page->update(['sections' => array_filter($sections, fn ($value) => $value !== null)]);
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

    private function canEditContent(Page $page): bool
    {
        return in_array($page->slug, self::CONTENT_EDITABLE_SLUGS, true);
    }

    private function canEditIntro(Page $page): bool
    {
        return in_array($page->slug, self::INTRO_EDITABLE_SLUGS, true);
    }
}

// ──────────────────────────────────────────────────────────────
// LeadController (Admin)
// ──────────────────────────────────────────────────────────────
