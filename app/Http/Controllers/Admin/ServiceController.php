<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\ImageService;
use App\Services\SeoService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private ImageService $imageService, private SeoService $seoService) {}

    public function index()
    {
        $services = Service::orderBy('order')->paginate(20);

        return view('admin.expertise.index', compact('services'));
    }

    public function create()
    {
        return view('admin.expertise.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'short_description' => 'required|string|max:300',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'youtube_url' => 'nullable|url|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'services');
            $validated['featured_image'] = $paths['medium'];
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $service = Service::create($validated);
        $this->seoService->saveFor($service, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));

        return redirect()->route('admin.expertise.index')->with('success', 'Service created.');
    }

    public function edit(Service $expertise)
    {
        $expertise->load('seo');

        return view('admin.expertise.edit', ['service' => $expertise]);
    }

    public function update(Request $request, Service $expertise)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'short_description' => 'required|string|max:300',
            'description' => 'required|string',
            'icon' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'youtube_url' => 'nullable|url|max:255',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'public', 'services');
            $validated['featured_image'] = $paths['medium'];
        }

        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        $expertise->update($validated);
        $this->seoService->saveFor($expertise, $request->only(['meta_title', 'meta_description', 'meta_keywords', 'og_image', 'robots']));

        return redirect()->route('admin.expertise.index')->with('success', 'Expertise updated.');
    }

    public function destroy(Service $expertise)
    {
        $expertise->delete();

        return back()->with('success', 'Expertise deleted.');
    }
}

// ──────────────────────────────────────────────────────────────
// PageController (Admin) - edit only
// ──────────────────────────────────────────────────────────────
