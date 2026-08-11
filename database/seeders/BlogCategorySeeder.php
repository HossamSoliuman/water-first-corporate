<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Water Treatment',
                'description' => 'Source water, process selection and the decisions that fix treated-water quality.',
            ],
            [
                'name' => 'Wastewater & Reuse',
                'description' => 'STP, ETP and CETP practice, resource recovery and putting treated water back to work.',
            ],
            [
                'name' => 'Infrastructure Delivery',
                'description' => 'Networks, pumping stations, DPRs and tenders — how schemes get funded, built and commissioned.',
            ],
            [
                'name' => 'Regulation & Compliance',
                'description' => 'NGT, CPCB and MoEF&CC requirements, audits, EIA and staying inside consent conditions.',
            ],
            [
                'name' => 'Sustainability & ESG',
                'description' => 'Water balance, carbon footprint, BRSR and disclosure that can be traced back to measurement.',
            ],
        ];

        foreach ($categories as $index => $category) {
            BlogCategory::updateOrCreate(
                ['name' => $category['name']],
                array_merge($category, ['is_active' => true, 'order' => $index + 1])
            );
        }

        BlogCategory::query()
            ->whereIn('name', [
                'Engineering Insights', 'Infrastructure News', 'Digital Engineering',
                'Project Spotlights', 'Industry Trends',
            ])
            ->update(['is_active' => false]);
    }
}
