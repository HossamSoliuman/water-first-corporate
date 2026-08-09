<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::whereIn('name', [
            'Shivam Gade',
            'Akshay Chavare',
            'Chetan Waghcahuare',
            'Dhananjay Durgude',
            'Aishwarya Andure',
            'Deoyani Gulhane',
            'Dhanashree Shinde',
        ])->delete();

        TeamMember::updateOrCreate(
            ['name' => 'Uma Upadhyay'],
            [
                'role' => 'Founder · Environmental Engineer · 19 years experience',
                'photo' => '',
                'order' => 1,
            ]
        );
    }
}
