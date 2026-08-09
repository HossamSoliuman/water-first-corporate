<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\JobListing;
use App\Models\Page;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class CareerController extends Controller
{
    public function index(): View
    {
        $contactEmail = Setting::get('contact_email');
        $phone = Setting::get('phone');
        $careersPage = Page::where('slug', 'careers')->firstOrFail();

        abort_unless($careersPage->is_published, 404);

        $sections = $careersPage->sections ?? [];

        $seo = [
            'title' => 'Careers at WaterFirst | WaterFirst',
            'description' => 'Build practical water and environmental engineering experience with WaterFirst in Bangalore.',
            'og_title' => 'Careers at WaterFirst | WaterFirst',
            'og_description' => 'Build practical water and environmental engineering experience with WaterFirst in Bangalore.',
        ];

        $hero = [
            'heading' => $sections['hero_heading'] ?? 'Engineer work that keeps water moving.',
            'tagline' => $sections['hero_tagline'] ?? 'Join a close, technically ambitious team solving municipal and industrial water challenges from Bangalore.',
        ];

        $intro = [
            'label' => $sections['intro_label'] ?? 'Join our team',
            'heading' => $sections['intro_heading'] ?? 'Grow through real engineering responsibility',
            'body_1' => $sections['intro_body_1'] ?? 'At WaterFirst, early-career and experienced engineers work close to project decisions, field conditions and client teams.',
            'body_2' => $sections['intro_body_2'] ?? 'Build multidisciplinary experience across process, civil, mechanical, electrical, instrumentation, digital delivery and environmental compliance.',
            'body_3' => $sections['intro_body_3'] ?? 'We value curiosity, ownership, clear communication and respect for the people affected by our designs.',
        ];

        $jobsSection = [
            'heading' => $sections['jobs_heading'] ?? 'Open roles',
            'subheading' => $sections['jobs_subheading'] ?? 'Explore current opportunities with our Bangalore engineering team.',
        ];

        $whySection = [
            'heading' => $sections['why_heading'] ?? 'Why work with us?',
            'subheading' => $sections['why_subheading'] ?? 'Build breadth, depth and responsibility on practical water infrastructure.',
        ];

        $whyCards = [
            ['title' => 'Work close to the problem', 'body' => 'Connect calculations and drawings to field conditions, operating teams and client decisions.'],
            ['title' => 'Build multidisciplinary range', 'body' => 'Collaborate across process, civil, mechanical, electrical, instrumentation and environmental work.'],
            ['title' => 'Learn from senior engineers', 'body' => 'Work with professionals carrying 15–35 years of water and wastewater experience.'],
            ['title' => 'Own meaningful deliverables', 'body' => 'Take responsibility for clear technical outputs and grow through direct feedback.'],
            ['title' => 'Serve public and industrial clients', 'body' => 'Contribute to municipal water, sewerage, CETP, industrial effluent and reuse projects.'],
            ['title' => 'Engineer for sustainability', 'body' => 'Pursue solutions that balance compliance, lifecycle cost and environmental performance.'],
        ];

        $jobs = JobListing::active()->get();

        return view('frontend.career', compact(
            'jobs',
            'contactEmail',
            'phone',
            'seo',
            'hero',
            'intro',
            'jobsSection',
            'whySection',
            'whyCards'
        ));
    }
}
