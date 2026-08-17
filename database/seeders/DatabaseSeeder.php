<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * `SettingSeeder` owns the brand (name, logo, contact details) and
     * `TeamMemberSeeder` owns the people; everything else — pages, services,
     * industries, case studies, blogs, jobs — now comes from
     * database/data/site-content.json via `SiteContentSeeder`.
     *
     * The per-model content seeders it replaces (PageSeeder, ServiceSeeder,
     * CaseStudySeeder, BlogSeeder, …) are intentionally left in the repo but
     * unwired: they still hold the original water-only expertise taxonomy, and
     * running them alongside this seeder would delete the imported rows.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            TeamMemberSeeder::class,
            SiteContentSeeder::class,
        ]);
    }
}
