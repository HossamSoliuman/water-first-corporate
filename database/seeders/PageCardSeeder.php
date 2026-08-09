<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageCard;
use Illuminate\Database\Seeder;

class PageCardSeeder extends Seeder
{
    public function run(): void
    {
        $sets = [
            'why-choose-us' => [
                ['Creatively deliver high-quality solutions', 'Apply technical rigour and creative thinking to reach outcomes that work in practice.'],
                ['Comprehensive approach and region-specific focus', 'Connect every discipline to local water, regulatory and operating conditions.'],
                ['Close interaction with clients and project teams on site', 'Keep communication direct and engineering decisions grounded in field reality.'],
                ['Maintain ownership and respect confidentiality', 'Stay accountable for the work while protecting sensitive project and client information.'],
                ['Cost-effective sustainable solutions — integrating all stakeholders involved', 'Balance lifecycle value, environmental outcomes and stakeholder requirements.'],
            ],
            'business-models' => [
                ['Defined Engineering Package', 'A clear scope, programme and fee for feasibility, DPR, FEED or detailed engineering deliverables.'],
                ['Time & Expertise Support', 'Flexible specialist capacity for evolving scopes, reviews, troubleshooting or procurement support.'],
                ['Project Management Consultancy', 'Integrated coordination, reporting, quality oversight and technical support through delivery.'],
                ['Operations & Maintenance Partnership', 'Performance-focused plant operations, troubleshooting and team training over the asset lifecycle.'],
            ],
        ];

        foreach ($sets as $slug => $cards) {
            $page = Page::where('slug', $slug)->first();

            if (! $page) {
                continue;
            }

            PageCard::where('page_id', $page->id)->whereNotIn('title', array_column($cards, 0))->delete();

            foreach ($cards as $index => [$title, $description]) {
                PageCard::updateOrCreate(
                    ['page_id' => $page->id, 'title' => $title],
                    ['description' => $description, 'order' => $index + 1]
                );
            }
        }
    }
}
