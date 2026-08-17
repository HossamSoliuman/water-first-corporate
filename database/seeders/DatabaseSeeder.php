<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Builds a complete install, so `php artisan migrate:fresh --seed` on an
     * empty database yields a browsable site and a usable `/admin` login.
     *
     * `UserSeeder` runs first because `SiteContentSeeder` attaches the imported
     * blogs to an existing user and leaves them authorless if none exists, and
     * `SettingSeeder` runs before it too because the content's `{{site_name}}` /
     * `{{contact_email}}` / `{{phone}}` tokens resolve from `settings`.
     *
     * `TeamMemberSeeder` owns the people; everything else — pages, services,
     * industries, case studies, blogs, jobs — comes from
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
            UserSeeder::class,
            SettingSeeder::class,
            TeamMemberSeeder::class,
            SiteContentSeeder::class,
        ]);
    }
}
