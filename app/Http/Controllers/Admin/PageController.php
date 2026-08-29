<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Services\SeoService;
use Illuminate\Http\Request;
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

        return view('admin.pages.edit', compact('page', 'canEditContent'));
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

        $validated = $request->validate($rules);

        if ($this->canEditContent($page)) {
            $page->update([
                'title' => $validated['title'],
                'subtitle' => $validated['subtitle'] ?? null,
                'content' => $validated['content'] ?? null,
                'is_published' => $request->boolean('is_published'),
            ]);
        }

        $this->seoService->saveFor($page, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));

        return back()->with('success', 'Page updated successfully.');
    }

    private function canEditContent(Page $page): bool
    {
        return in_array($page->slug, self::CONTENT_EDITABLE_SLUGS, true);
    }
}

// ──────────────────────────────────────────────────────────────
// LeadController (Admin)
// ──────────────────────────────────────────────────────────────
