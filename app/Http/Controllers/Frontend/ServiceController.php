<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Services\SeoService;

class ServiceController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $services = Service::active()->get();

        return view('frontend.expertise.index', compact('services'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->with('seo')->firstOrFail();
        $seo = $this->seoService->for($service);
        $related = Service::active()->where('id', '!=', $service->id)->get();

        return view('frontend.expertise.show', compact('service', 'seo', 'related'));
    }
}

// ──────────────────────────────────────────────────────────────
// IndustryController
// ──────────────────────────────────────────────────────────────
