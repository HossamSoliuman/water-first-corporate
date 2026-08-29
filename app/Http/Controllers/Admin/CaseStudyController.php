<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use App\Models\Industry;
use App\Services\ImageService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaseStudyController extends Controller
{
    public function __construct(private ImageService $imageService, private SeoService $seoService) {}

    public function index(Request $request)
    {
        $query = CaseStudy::with(['category', 'industry'])->orderBy('order')->orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $query->where('title', 'like', "%{$request->search}%");
        }
        $caseStudies = $query->paginate(15)->withQueryString();

        return view('admin.case-studies.index', compact('caseStudies'));
    }

    public function create()
    {
        $categories = CaseStudyCategory::active()->get();
        $industries = Industry::active()->get();

        return view('admin.case-studies.create', compact('categories', 'industries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'case_study_category_id' => 'nullable|exists:case_study_categories,id',
            'industry_id' => 'nullable|exists:industries,id',
            'client_name' => 'nullable|string|max:150',
            'challenge' => 'required|string',
            'solution' => 'required|string',
            'result' => 'required|string',
            'featured_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'pdf_file' => 'nullable|mimes:pdf|max:10240',
            'cta_title' => 'nullable|string|max:150',
            'cta_text' => 'nullable|string|max:500',
            'cta_link' => 'nullable|url',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'uploads/case-studies');
            $validated['featured_image'] = $paths['large'];
        }

        if ($request->hasFile('pdf_file')) {
            $pdfDir = public_path('uploads/case-studies/pdfs');
            if (! is_dir($pdfDir)) {
                mkdir($pdfDir, 0755, true);
            }
            $pdfName = Str::uuid().'.'.$request->file('pdf_file')->getClientOriginalExtension();
            $request->file('pdf_file')->move($pdfDir, $pdfName);
            $validated['pdf_file'] = 'uploads/case-studies/pdfs/'.$pdfName;
        }

        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $file) {
                $paths = $this->imageService->upload($file, 'public', 'uploads/case-studies/gallery');
                $gallery[] = $paths['large'];
            }
            $validated['gallery'] = $gallery;
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');
        if ($validated['is_published']) {
            $validated['published_at'] = now();
        }

        $cs = CaseStudy::create($validated);
        $this->seoService->saveFor($cs, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study created.');
    }

    public function edit(CaseStudy $caseStudy)
    {
        $caseStudy->load('seo');
        $categories = CaseStudyCategory::active()->get();
        $industries = Industry::active()->get();

        return view('admin.case-studies.edit', compact('caseStudy', 'categories', 'industries'));
    }

    public function update(Request $request, CaseStudy $caseStudy)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'case_study_category_id' => 'nullable|exists:case_study_categories,id',
            'industry_id' => 'nullable|exists:industries,id',
            'client_name' => 'nullable|string|max:150',
            'challenge' => 'required|string',
            'solution' => 'required|string',
            'result' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'remove_gallery' => 'nullable|array',
            'remove_gallery.*' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'uploads/case-studies');
            $validated['featured_image'] = $paths['large'];
        }

        $toRemove = $request->input('remove_gallery', []);
        $gallery = array_values(array_filter($caseStudy->gallery ?? [], fn ($path) => ! in_array($path, $toRemove)));

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $paths = $this->imageService->upload($file, 'public', 'uploads/case-studies/gallery');
                $gallery[] = $paths['large'];
            }
        }

        $validated['gallery'] = $gallery ?: null;

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_published'] = $request->boolean('is_published');

        $caseStudy->update($validated);
        $this->seoService->saveFor($caseStudy, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));

        return redirect()->route('admin.case-studies.index')->with('success', 'Case study updated.');
    }

    public function destroy(CaseStudy $caseStudy)
    {
        $caseStudy->delete();

        return back()->with('success', 'Case study deleted.');
    }
}

// ──────────────────────────────────────────────────────────────
// CaseStudyCategoryController (Admin)
// ──────────────────────────────────────────────────────────────
