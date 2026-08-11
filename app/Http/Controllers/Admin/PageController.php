<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Slugs of the only pages that are editable from the admin Pages screen.
     * Every other page row stays in the database — the public site reads it —
     * but is not surfaced for editing.
     *
     * @var list<string>
     */
    private const EDITABLE_SLUGS = ['privacy-policy', 'terms-conditions'];

    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $pages = Page::whereIn('slug', self::EDITABLE_SLUGS)->get();

        return view('admin.pages.index', compact('pages'));
    }

    public function edit(Page $page)
    {
        $page->load('seo');

        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'subtitle' => 'nullable|string|max:300',
            'content' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'side_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'is_published' => 'boolean',
        ]);

        $validated['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storePageImage($request->file('featured_image'));
        } else {
            unset($validated['featured_image']);
        }

        // Sections come from named array inputs (sections[key]) on custom page types.
        // Handle outside validation so type mismatches from stale requests never block saves.
        $sections = $request->input('sections');
        if (is_array($sections)) {
            $sections = array_filter($sections, fn ($v) => $v !== null && $v !== '');
        } else {
            $sections = [];
        }

        // Preserve previously stored image paths held in sections.
        $sections = array_merge(array_intersect_key($page->sections ?? [], ['side_image' => true]), $sections);

        if ($request->hasFile('side_image')) {
            $sections['side_image'] = $this->storePageImage($request->file('side_image'));
        }

        if ($sections !== []) {
            $validated['sections'] = $sections;
        }

        $page->update($validated);
        $this->seoService->saveFor($page, $request->only(['meta_title', 'meta_description', 'og_image', 'robots']));

        return back()->with('success', 'Page updated successfully.');
    }

    private function storePageImage(UploadedFile $file): string
    {
        $dir = public_path('pages');
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();
        $file->move($dir, $filename);

        return 'pages/'.$filename;
    }
}

// ──────────────────────────────────────────────────────────────
// LeadController (Admin)
// ──────────────────────────────────────────────────────────────
