<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            PageSeeder::class,
            PageCardSeeder::class,
            ServiceSeeder::class,
            IndustrySeeder::class,
            CaseStudyCategorySeeder::class,
            CaseStudySeeder::class,
            SoftwareLogoSeeder::class,
            TeamMemberSeeder::class,
            BlogCategorySeeder::class,
            BlogTagSeeder::class,
            BlogSeeder::class,
            JobListingSeeder::class,
        ]);
    }
}
