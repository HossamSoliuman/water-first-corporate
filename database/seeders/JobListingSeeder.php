<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Seeder;

/**
 * Open roles shown on /careers.
 *
 * Positions mirror the disciplines WaterFirst actually delivers (process, civil,
 * mechanical, electrical and instrumentation, modelling, environmental compliance
 * and O&M). Titles and locations are placeholders pending client confirmation of
 * the live vacancy list — they are editable at /admin/job-listings.
 *
 * `employment_type` is constrained by the schema to full-time / part-time.
 */
class JobListingSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'position_name' => 'Senior Process Engineer — STP, ETP & CETP',
                'location' => 'Bangalore, Karnataka',
                'employment_type' => 'full-time',
            ],
            [
                'position_name' => 'Process Engineer — Drinking Water Treatment',
                'location' => 'Bangalore, Karnataka',
                'employment_type' => 'full-time',
            ],
            [
                'position_name' => 'Hydraulic Modelling Engineer — Water & Sewer Networks',
                'location' => 'Bangalore, Karnataka',
                'employment_type' => 'full-time',
            ],
            [
                'position_name' => 'Mechanical & Piping Design Engineer',
                'location' => 'Bangalore, Karnataka',
                'employment_type' => 'full-time',
            ],
            [
                'position_name' => 'Electrical & Instrumentation Engineer',
                'location' => 'Bangalore, Karnataka',
                'employment_type' => 'full-time',
            ],
            [
                'position_name' => 'Environmental Engineer — Audits, EIA & Compliance',
                'location' => 'Bangalore, Karnataka',
                'employment_type' => 'full-time',
            ],
            [
                'position_name' => 'Proposals & DPR Engineer',
                'location' => 'Bangalore, Karnataka',
                'employment_type' => 'full-time',
            ],
            [
                'position_name' => 'Commissioning & O&M Engineer',
                'location' => 'Project site — deputation',
                'employment_type' => 'full-time',
            ],
            [
                'position_name' => 'Engineering Intern — Water & Wastewater',
                'location' => 'Bangalore, Karnataka',
                'employment_type' => 'part-time',
            ],
        ];

        foreach ($roles as $index => $role) {
            JobListing::updateOrCreate(
                ['position_name' => $role['position_name']],
                array_merge($role, ['order' => $index + 1, 'is_active' => true])
            );
        }
    }
}
