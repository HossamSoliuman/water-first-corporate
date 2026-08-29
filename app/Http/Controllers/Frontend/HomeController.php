<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\HeroSlide;
use App\Models\Industry;
use App\Models\Page;
use App\Models\Service;
use App\Models\SoftwareLogo;
use App\Services\SeoService;

class HomeController extends Controller
{
    public function __construct(private SeoService $seoService) {}

    public function index()
    {
        $featuredCaseStudies = CaseStudy::published()->featured()->with(['category', 'industry'])->limit(3)->get();

        if ($featuredCaseStudies->isEmpty()) {
            $featuredCaseStudies = CaseStudy::published()->with(['category', 'industry'])->latest('id')->limit(3)->get();
        }

        $data = [
            'heroVideo' => HeroSlide::active()->first(),
            'expertiseServices' => Service::active()->get(['id', 'name', 'slug']),
            'featuredServices' => Service::active()->featured()->with('seo')->limit(6)->get(),
            'supportingServices' => Service::active()->where('is_featured', false)->limit(6)->get(),
            'featuredCaseStudies' => $featuredCaseStudies,
            'latestBlogs' => Blog::published()->with(['category', 'author'])->latest('published_at')->limit(3)->get(),
            'industries' => Industry::active()->limit(8)->get(),
            'softwareLogos' => SoftwareLogo::ordered()->get(),
            'softwareSection' => SoftwareLogo::sectionSettings(),
        ];

        $page = Page::where('slug', 'home')->first();
        $seo = $page ? $this->seoService->for($page) : [];

        return view('frontend.home', array_merge($data, compact('seo', 'page')));
    }
}
