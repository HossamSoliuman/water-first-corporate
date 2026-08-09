<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::where('slug', 'about')->update(['slug' => 'company-overview']);

        $pages = [
            ['slug' => 'home', 'title' => 'WaterFirst Engineering Consultancy', 'subtitle' => 'Sustainable water, wastewater and environmental engineering from Bangalore, India.', 'content' => null, 'sections' => null],
            ['slug' => 'company-overview', 'title' => 'WaterFirst Engineering Consultancy Private Limited', 'subtitle' => 'A Bangalore-based, water-led environmental and infrastructure engineering practice.', 'content' => '<p>WaterFirst develops sustainable technical solutions to challenging environmental problems across municipal and industrial water and wastewater systems.</p>', 'sections' => null],
            ['slug' => 'our-team', 'title' => 'Our Team', 'subtitle' => 'Senior water and environmental engineering experience, connected directly to every project.', 'content' => null, 'sections' => ['intro_label' => 'Technical leadership', 'intro_heading' => 'Experience that stays close to the work', 'intro_body' => "Our team brings 15–35 years of experience across water, wastewater, solids management, effluent treatment, sewerage, water supply, waterbody rejuvenation and plant operations.\n\nFounder Uma Upadhyay is an IIT Roorkee alumna with a postgraduate qualification in Environmental Engineering and 19 years of water and wastewater treatment experience."]],
            ['slug' => 'why-choose-us', 'title' => 'Why Choose WaterFirst', 'subtitle' => 'Creative, comprehensive and accountable engineering shaped around local conditions and client outcomes.', 'content' => null, 'sections' => ['intro_label' => 'Ownership in practice', 'intro_heading' => 'Close collaboration, clear responsibility', 'intro_body' => "WaterFirst combines creative problem-solving with a comprehensive, region-specific approach. We stay close to client and project teams on site so decisions remain grounded in operating reality.\n\nOur work protects confidentiality, integrates stakeholders and pursues sustainable outcomes without losing sight of time or cost."]],
            ['slug' => 'business-models', 'title' => 'Business Models', 'subtitle' => 'Flexible engagement structures for studies, detailed engineering, delivery support and long-term operations.', 'content' => null, 'sections' => ['intro_label' => 'Fit-for-purpose delivery', 'intro_heading' => 'The right commercial model for the project stage', 'intro_body' => "A focused study, a defined detailed-engineering package and a long-term O&M programme require different commitments. We structure scope, responsibility and reporting around the decision the client needs to make.\n\nEvery model preserves technical ownership, transparent communication and disciplined delivery."]],
            ['slug' => 'careers', 'title' => 'Careers at WaterFirst', 'subtitle' => 'Build practical engineering experience on water and environmental projects that matter.', 'content' => null, 'sections' => ['hero_heading' => 'Engineer work that keeps water moving.', 'hero_tagline' => 'Join a close, technically ambitious team solving municipal and industrial water challenges from Bangalore.', 'intro_label' => 'Join our team', 'intro_heading' => 'Grow through real engineering responsibility', 'intro_body_1' => 'At WaterFirst, early-career and experienced engineers work close to project decisions, field conditions and client teams.', 'intro_body_2' => 'You will build multidisciplinary experience across process, civil, mechanical, electrical, instrumentation, digital delivery and environmental compliance.', 'intro_body_3' => 'We value curiosity, ownership, clear communication and respect for the people affected by our designs.', 'jobs_heading' => 'Open roles', 'jobs_subheading' => 'Explore current opportunities with our Bangalore engineering team.', 'why_heading' => 'Why work with us?', 'why_subheading' => 'Build breadth, depth and responsibility on practical water infrastructure.']],
            ['slug' => 'privacy-policy', 'title' => 'Privacy Policy', 'subtitle' => 'How WaterFirst handles website enquiries and personal information.', 'content' => '<p>WaterFirst uses information submitted through this website only to respond to enquiries, evaluate project or career requests, and maintain appropriate business records. Contact us to request access, correction or deletion of your information.</p>', 'sections' => null],
            ['slug' => 'terms-conditions', 'title' => 'Terms & Conditions', 'subtitle' => 'Terms for use of the WaterFirst website.', 'content' => '<p>Website content is provided for general information and does not constitute project-specific engineering advice. Project services are governed by the terms of the applicable written agreement.</p>', 'sections' => null],
        ];

        foreach ($pages as $page) {
            $savedPage = Page::updateOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, ['is_published' => true, 'published_at' => now()])
            );

            SeoMeta::updateOrCreate(
                ['seoable_type' => Page::class, 'seoable_id' => $savedPage->id],
                [
                    'meta_title' => $page['title'].' | WaterFirst',
                    'meta_description' => $page['subtitle'],
                    'meta_keywords' => null,
                    'canonical_url' => null,
                    'og_title' => $page['title'],
                    'og_description' => $page['subtitle'],
                    'og_image' => null,
                    'twitter_title' => $page['title'],
                    'twitter_description' => $page['subtitle'],
                    'twitter_image' => null,
                    'schema_json' => null,
                    'robots' => 'index,follow',
                ]
            );
        }
    }
}
