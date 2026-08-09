<?php

namespace Database\Seeders;

use App\Models\CaseStudyCategory;
use Illuminate\Database\Seeder;

class CaseStudyCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Advisory & Studies', 'Detailed Engineering', 'EPC Support', 'Operations & Maintenance'];

        foreach ($categories as $index => $name) {
            CaseStudyCategory::updateOrCreate(
                ['name' => $name],
                ['is_active' => true, 'order' => $index + 1]
            );
        }

        CaseStudyCategory::query()
            ->whereIn('name', [
                'Digital Transformation', 'Cloud Migration', 'Process Automation', 'System Integration',
                'Infrastructure Development', 'Structural Engineering', 'Land Development', 'Water Engineering',
                'Environmental Engineering', 'Transportation Engineering', 'Urban Planning', 'Smart Cities',
                'BIM & Digital Engineering', 'Industrial Engineering', 'Oil & Gas Projects',
                'Energy & Power Systems', 'MEPF Engineering', 'Geotechnical Engineering',
                'Surveying & Mapping', 'Road & Highway Design', 'Building Design',
            ])
            ->update(['is_active' => false]);
    }
}
