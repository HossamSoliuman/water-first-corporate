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
        $data = [
            'heroVideo' => HeroSlide::active()->first(),
            'featuredServices' => Service::active()->featured()->with('seo')->limit(6)->get(),
            'supportingServices' => Service::active()->where('is_featured', false)->limit(6)->get(),
            'featuredCaseStudies' => CaseStudy::published()->featured()->with(['category', 'industry'])->limit(3)->get(),
            'latestBlogs' => Blog::published()->with(['category', 'author'])->latest('published_at')->limit(3)->get(),
            'industries' => Industry::active()->limit(8)->get(),
            'softwareLogos' => SoftwareLogo::ordered()->get(),
        ];

        $page = Page::where('slug', 'home')->first();
        $seo = $page ? $this->seoService->for($page) : [];

        return view('frontend.home', array_merge($data, compact('seo', 'page')));
    }
}
