<?php

namespace Tests\Feature;

use App\Models\CaseStudy;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\SoftwareLogo;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WaterFirstContentSeederTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_waterfirst_expertise_matches_the_presentation_service_areas(): void
    {
        $this->assertSame([
            'Water Supply & Distribution Systems',
            'Drinking Water Treatment',
            'Sewerage Systems, Networks & Pumping Stations',
            'Wastewater Treatment — STP, ETP & CETP',
            'Industrial Wastewater & Process Water',
            'Water Reuse, Recycling & Desalination',
            'Sludge, Biosolids & Solid Waste Management',
            'Sustainability, ESG & Climate Disclosure',
            'Water Audit, EHS & Environmental Assessment',
            'Detailed Engineering & Design',
            'DPR, Tender & Procurement Support',
            'Project Management, Operations & Maintenance',
        ], Service::query()->where('is_active', true)->orderBy('order')->pluck('name')->all());

        $this->assertSame(6, Service::query()->where('is_active', true)->where('is_featured', true)->count());
        $this->assertSame('wastewater-treatment-stp-etp-cetp', Service::query()->where('order', 4)->value('slug'));
    }

    public function test_pre_waterfirst_services_are_removed_rather_than_deactivated(): void
    {
        $this->assertSame(12, Service::query()->count());

        $this->assertSame(0, Service::query()->whereIn('name', [
            'Transportation Infrastructure Engineering',
            'Structural Engineering',
            'Architectural Design Services',
            'BIM & Digital Engineering',
            'MEPF Engineering Services',
            'Project & Construction Management',
        ])->count());
    }

    public function test_all_eighteen_presentation_projects_are_published_individually(): void
    {
        $this->assertSame(18, CaseStudy::published()->count());

        $this->assertSame(
            'End client: BWSSB, Bangalore · Status: Completed',
            CaseStudy::query()->where('slug', '1-mld-decentralized-stp-mantri-square-malleshwaram')->value('client_name')
        );
        $this->assertSame(
            'Consultant: ROOT · Contractor: SNC · End client: RDWSB, Bangalore · Status: Completed',
            CaseStudy::query()->where('slug', '36-mld-wtp-karkala-hebri-kaup')->value('client_name')
        );
        $this->assertSame(
            'Consultant: Fichtner · End client: NMCG / KMC · Status: Ongoing',
            CaseStudy::query()->where('slug', 'stp-15-year-om-garden-reach-kolkata')->value('client_name')
        );
        $this->assertSame(
            'Consultant: WASHI (NGO) · End client: Swachh Bharat Mission 2.0 · Status: Completed',
            CaseStudy::query()->where('slug', 'sewerage-network-design-chunar')->value('client_name')
        );
    }

    public function test_company_profile_and_software_match_the_waterfirst_presentation(): void
    {
        $companyOverview = Page::query()->where('slug', 'company-overview')->firstOrFail();

        $this->assertStringContainsString('Uma Upadhyay', $companyOverview->content);
        $this->assertStringContainsString('15–35 years', $companyOverview->content);
        $this->assertSame('WaterFirst', Setting::query()->where('key', 'site_name')->value('value'));
        $this->assertSame('Bangalore, Karnataka, India', Setting::query()->where('key', 'address_india')->value('value'));
        $this->assertSame([
            'WaterGEMS',
            'SewerGEMS',
            'StormCAD',
            'EPANET',
            'AutoCAD',
            'Civil 3D',
            'Revit',
            'Plant 3D',
            'Mechanical Desktop',
            'SolidWorks',
            'GIS',
        ], SoftwareLogo::query()->orderBy('order')->pluck('name')->all());
    }

    public function test_waterfirst_content_seeders_are_idempotent(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(12, Service::query()->where('is_active', true)->count());
        $this->assertSame(18, CaseStudy::published()->count());
        $this->assertSame(11, SoftwareLogo::query()->count());
        $this->assertSame(
            '2-5-mld-cetp-tumakuru-cbic-node',
            CaseStudy::query()->where('title', '2.5 MLD CETP — Tumakuru CBIC Node')->value('slug')
        );
    }
}
