<?php

namespace Database\Seeders;

use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Process Design', 'Source Water', 'Drinking Water', 'STP', 'UASB', 'Sludge',
            'Biogas', 'Water Reuse', 'Desalination', 'Sewerage', 'Pumping Stations',
            'Hydraulic Modelling', 'Non-Revenue Water', 'Water Audit', 'NGT Standards',
            'BRSR', 'ESG', 'DPR', 'Tendering', 'O&M',
        ];

        foreach ($tags as $tag) {
            BlogTag::updateOrCreate(['name' => $tag]);
        }

        /** Legacy Alada-era tags: drop them unless an article still uses one. */
        BlogTag::query()
            ->whereIn('name', ['Technology', 'Innovation', 'Strategy', 'Growth', 'Digital', 'Marketing', 'Leadership', 'Sustainability'])
            ->whereDoesntHave('blogs')
            ->delete();
    }
}
