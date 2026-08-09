<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    public function run(): void
    {
        $industries = [
            ['name' => 'Municipal Water & Sewerage', 'slug' => 'municipal-water-sewerage', 'icon' => 'building-office-2', 'description' => 'Water supply, sewer networks, pumping stations, STPs and long-term O&M for cities and public agencies.'],
            ['name' => 'Industrial Effluent & CETP', 'slug' => 'industrial-effluent-cetp', 'icon' => 'beaker', 'description' => 'ETP and CETP solutions for compliant discharge, resource recovery and fit-for-purpose reuse.'],
            ['name' => 'Waterbody Rejuvenation', 'slug' => 'waterbody-rejuvenation', 'icon' => 'globe-alt', 'description' => 'Decentralised treatment, catchment controls and restoration strategies for lakes, rivers and urban waterbodies.'],
            ['name' => 'Desalination', 'slug' => 'desalination', 'icon' => 'sparkles', 'description' => 'Seawater and brackish-water treatment, pretreatment, membrane processes and concentrate management.'],
            ['name' => 'Green Hydrogen', 'slug' => 'green-hydrogen', 'icon' => 'bolt', 'description' => 'High-purity water, reuse and utility systems for green hydrogen production facilities.'],
            ['name' => 'Pharma & Chemical', 'slug' => 'pharma-chemical', 'icon' => 'cog-6-tooth', 'description' => 'Complex effluent treatment, segregation, reuse and environmental compliance for process industries.'],
            ['name' => 'Steel & Heavy Industry', 'slug' => 'steel-heavy-industry', 'icon' => 'building-office', 'description' => 'Water balance, process water, effluent, solids and environmental advisory for heavy industrial operations.'],
            ['name' => 'Pulp & Paper', 'slug' => 'pulp-paper', 'icon' => 'clipboard-document-list', 'description' => 'High-load wastewater treatment, anaerobic processes, water reuse and solids management for paper production.'],
        ];

        foreach ($industries as $index => $industry) {
            Industry::updateOrCreate(
                ['slug' => $industry['slug']],
                array_merge($industry, ['is_active' => true, 'order' => $index + 1])
            );
        }

        Industry::query()
            ->whereIn('name', [
                'Energy & LNG', 'Oil & Gas', 'Transportation', 'Water Infrastructure',
                'Smart Cities', 'Commercial Buildings', 'Industrial Facilities', 'Renewable Energy',
                'Smart Cities & Urban Development', 'Transportation & Infrastructure', 'Water Infrastructure',
                'Oil & Gas Infrastructure', 'Renewable Energy System', 'Residential & Commercial Buildings',
                'BIM & GIS Services',
            ])
            ->update(['is_active' => false]);
    }
}
