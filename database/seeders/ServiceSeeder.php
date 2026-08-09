<?php

namespace Database\Seeders;

use App\Models\SeoMeta;
use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Water, Wastewater & Drainage Engineering',
                'slug' => 'water-wastewater-drainage-engineering',
                'icon' => 'beaker',
                'short_description' => 'Process and infrastructure engineering for water supply, sewerage, effluent treatment, reuse, desalination and drainage.',
                'description' => '<h2>Water-led engineering from source to reuse</h2><p>WaterFirst delivers concept design, FEED, detailed engineering, DPRs, tender documentation, procurement support, PMC and O&amp;M for municipal and industrial water systems across India.</p><h3>Treatment and reuse</h3><ul><li>STP, ETP and CETP process design, including anaerobic digestion, biogas, power generation and CBG</li><li>Drinking water treatment, desalination and direct or indirect potable reuse</li><li>Wastewater reuse to industrial and potable standards</li><li>Sludge handling, beneficial reuse and solids management</li></ul><h3>Networks and delivery</h3><ul><li>Water supply, trunk sewer, pumping station and stormwater drainage design</li><li>PFD, P&amp;ID, GAD, BOQ, costing and technical bid evaluation</li><li>Hydraulic modelling using WaterGEMS, SewerGEMS, StormCAD and EPANET</li><li>Onsite troubleshooting, manpower training and long-term plant operations</li></ul><p>Designs are developed with project-specific attention to NGT standards and applicable MoEF&amp;CC and CPCB requirements.</p>',
            ],
            [
                'name' => 'Environmental Engineering & Hydrogeology',
                'slug' => 'environmental-engineering-hydrogeology',
                'icon' => 'globe-alt',
                'short_description' => 'Environmental assessment, hydrogeology, sustainability disclosure, water audits and compliance support for Indian projects.',
                'description' => '<h2>Environmental performance with defensible evidence</h2><p>Our environmental practice supports projects from baseline studies through approvals, implementation and operational assurance.</p><ul><li>EIA, ESA, EHS and customer audits</li><li>Groundwater studies, water audits and water-neutrality assessments</li><li>ESG and BRSR sustainability reporting</li><li>Carbon footprinting, climate disclosure and supply-chain decarbonisation</li><li>Zero-waste-to-landfill assessment and waterbody rejuvenation planning</li></ul><p>Recommendations are practical, region-specific and framed around applicable NGT, MoEF&amp;CC and CPCB expectations.</p>',
            ],
            [
                'name' => 'Transportation Infrastructure Engineering',
                'slug' => 'transportation-infrastructure-engineering',
                'icon' => 'truck',
                'short_description' => 'Corridor, roadway and transport infrastructure design coordinated with drainage, utilities and environmental requirements.',
                'description' => '<h2>Transport infrastructure coordinated below and above ground</h2><p>WaterFirst integrates alignment, grading, pavement, drainage and utility engineering so transport assets perform as complete systems.</p><ul><li>Road and corridor geometry</li><li>Stormwater, cross-drainage and utility coordination</li><li>Terrain modelling, quantities and tender documentation</li><li>Construction-stage technical support and as-built coordination</li></ul>',
            ],
            [
                'name' => 'Structural Engineering',
                'slug' => 'structural-engineering',
                'icon' => 'building-office',
                'short_description' => 'Durable structural systems for treatment plants, pumping facilities, industrial assets and public infrastructure.',
                'description' => '<h2>Structures designed for demanding operating environments</h2><p>We engineer reinforced concrete and steel structures with attention to process loads, equipment interfaces, durability, constructability and lifecycle maintenance.</p><ul><li>Treatment tanks, buildings and equipment foundations</li><li>Pumping stations and industrial structures</li><li>Structural analysis, detailing and quantity take-offs</li><li>Multidisciplinary design coordination and site support</li></ul>',
            ],
            [
                'name' => 'Architectural Design Services',
                'slug' => 'architectural-design-services',
                'icon' => 'building-library',
                'short_description' => 'Functional, climate-aware architecture for utility, institutional, industrial and infrastructure facilities.',
                'description' => '<h2>Architecture that works with engineering</h2><p>Our architectural design is coordinated from the outset with process, structure, MEPF, access, safety and operational workflows.</p><ul><li>Space planning and code-aware design</li><li>Utility and industrial facility architecture</li><li>Material, envelope and climate-response studies</li><li>BIM-based multidisciplinary coordination</li></ul>',
            ],
            [
                'name' => 'Urban & Infrastructure Development Engineering',
                'slug' => 'urban-infrastructure-development-engineering',
                'icon' => 'building-office-2',
                'short_description' => 'Integrated urban infrastructure planning for water, sewerage, drainage, utilities, public realm and resilient growth.',
                'description' => '<h2>Infrastructure planned as one connected system</h2><p>WaterFirst combines land development, utility, water, sewerage, drainage, transport and environmental inputs into coordinated urban programmes.</p><ul><li>Infrastructure master planning and feasibility</li><li>Land development, grading and utility corridors</li><li>DPR, BOQ, costing and tender documentation</li><li>Stakeholder, statutory and construction coordination</li></ul>',
            ],
            [
                'name' => 'Surveying, GIS & Geospatial Engineering Services',
                'slug' => 'surveying-gis-geospatial-engineering-services',
                'icon' => 'map',
                'short_description' => 'Survey, GIS and geospatial data workflows that make infrastructure planning and asset decisions traceable.',
                'description' => '<h2>Reliable spatial data for better engineering decisions</h2><p>We organise survey, terrain, network and asset information into coordinated engineering inputs and useful operational records.</p><ul><li>Topographic and utility survey coordination</li><li>GIS mapping, spatial analysis and corridor studies</li><li>Terrain and surface models</li><li>Asset registers and geospatial handover datasets</li></ul>',
            ],
            [
                'name' => 'Industrial, LNG, Oil & Gas & Energy Engineering',
                'slug' => 'industrial-lng-oil-gas-energy-engineering',
                'icon' => 'bolt',
                'short_description' => 'Multidisciplinary industrial and energy engineering with particular strength in process water, effluent and utilities.',
                'description' => '<h2>Industrial systems with water and environmental performance built in</h2><p>Our teams coordinate process utilities, pipelines, structures, electrical systems, instrumentation and environmental controls for industrial and energy facilities.</p><ul><li>Concept design, FEED and detailed engineering</li><li>Process water, effluent and utility networks</li><li>PFD, P&amp;ID, equipment layout and BOQ</li><li>Procurement, bid evaluation, PMC and commissioning support</li></ul>',
            ],
            [
                'name' => 'BIM & Digital Engineering',
                'slug' => 'bim-digital-engineering',
                'icon' => 'cpu-chip',
                'short_description' => 'Coordinated digital delivery using BIM, GIS, 3D plant design, clash detection and structured asset information.',
                'description' => '<h2>Digital coordination that reduces field uncertainty</h2><p>WaterFirst uses fit-for-purpose digital workflows to coordinate multidisciplinary design and produce reliable construction and handover information.</p><ul><li>BIM execution planning and model coordination</li><li>Revit, Civil 3D and Plant 3D delivery</li><li>Clash detection, quantities and drawing production</li><li>GIS integration and structured asset data</li></ul>',
            ],
            [
                'name' => 'MEPF Engineering Services',
                'slug' => 'mepf-engineering-services',
                'icon' => 'cog-6-tooth',
                'short_description' => 'Mechanical, electrical, plumbing and fire systems coordinated for safe, efficient and maintainable facilities.',
                'description' => '<h2>Building services integrated with process and operations</h2><p>We design and coordinate MEPF systems for treatment, industrial, institutional and infrastructure facilities.</p><ul><li>Mechanical ventilation and utility systems</li><li>Electrical distribution, lighting and backup power</li><li>Plumbing, drainage and fire protection</li><li>Instrumentation, PLC and automation coordination</li></ul>',
            ],
        ];

        foreach ($services as $index => $service) {
            $savedService = Service::updateOrCreate(
                ['slug' => $service['slug']],
                array_merge($service, [
                    'is_featured' => $index < 6,
                    'is_active' => true,
                    'order' => $index + 1,
                ])
            );

            SeoMeta::updateOrCreate(
                ['seoable_type' => Service::class, 'seoable_id' => $savedService->id],
                [
                    'meta_title' => $service['name'].' | WaterFirst',
                    'meta_description' => $service['short_description'],
                    'meta_keywords' => null,
                    'canonical_url' => null,
                    'og_title' => $service['name'],
                    'og_description' => $service['short_description'],
                    'og_image' => null,
                    'twitter_title' => $service['name'],
                    'twitter_description' => $service['short_description'],
                    'twitter_image' => null,
                    'schema_json' => null,
                    'robots' => 'index,follow',
                ]
            );
        }

        Service::query()
            ->whereIn('name', [
                'Infrastructure & Societal Development Engineering',
                'Urban Planning & Smart City Development',
                'Project & Construction Management',
            ])
            ->update(['is_active' => false, 'is_featured' => false]);

        Cache::forget('footer_services');
    }
}
