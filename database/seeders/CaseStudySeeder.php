<?php

namespace Database\Seeders;

use App\Models\CaseStudy;
use App\Models\CaseStudyCategory;
use App\Models\Industry;
use App\Models\SeoMeta;
use Illuminate\Database\Seeder;

class CaseStudySeeder extends Seeder
{
    public function run(): void
    {
        $categories = CaseStudyCategory::pluck('id', 'name');
        $industries = Industry::pluck('id', 'slug');

        $projects = [
            [
                'title' => 'Environment Advisory & Expert Services for JSW-JFE Steel',
                'slug' => 'environment-advisory-jsw-jfe-steel',
                'client_name' => 'JSW-JFE Steel Limited · End client · Ongoing',
                'category' => 'Advisory & Studies',
                'industry' => 'steel-heavy-industry',
                'challenge' => '<p>Provide senior environmental and water expertise for a major steel operation with complex compliance and operational interfaces.</p>',
                'solution' => '<p>WaterFirst provides focused advisory, technical review and expert support aligned with plant priorities and applicable environmental requirements.</p>',
                'result' => '<p>The ongoing engagement gives the client direct access to accountable specialist input for environmental decision-making.</p>',
            ],
            [
                'title' => '3.0 MLD Decentralized STP — Kenchenahalli / Pattangere Lake',
                'slug' => '3-mld-decentralized-stp-kenchenahalli-pattangere-lake',
                'client_name' => 'BWSSB · Bangalore · Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'waterbody-rejuvenation',
                'challenge' => '<p>Treat local sewage close to the receiving waterbody within a constrained urban setting.</p>',
                'solution' => '<p>Engineering support for a 3.0 MLD decentralized sewage treatment plant serving the Kenchenahalli / Pattangere Lake catchment.</p>',
                'result' => '<p>The completed system supports local treatment and reduced pollutant loading to the urban waterbody.</p>',
            ],
            [
                'title' => 'Decentralized STPs — Mantri Square, Subramanyapura & BDA Sculpture Park',
                'slug' => 'bwssb-decentralized-stps-bangalore',
                'client_name' => 'BWSSB · 1.0 MLD + 3.0 MLD + 3.0 MLD · Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Deliver decentralized treatment solutions across three distinct Bangalore sites with different flows and urban constraints.</p>',
                'solution' => '<p>Engineering inputs for 1.0 MLD at Mantri Square, Malleshwaram; 3.0 MLD at Subramanyapura ISPS; and 3.0 MLD at BDA Sculpture Park.</p>',
                'result' => '<p>All three project assignments were completed, adding distributed sewage treatment capacity across the city.</p>',
            ],
            [
                'title' => '2.5 MLD CETP — Tumakuru CBIC Node',
                'slug' => '2-5-mld-cetp-tumakuru-cbic-node',
                'client_name' => 'KIADB · Assystem STUP · L&T · EPC Phase A',
                'category' => 'EPC Support',
                'industry' => 'industrial-effluent-cetp',
                'challenge' => '<p>Develop common effluent treatment infrastructure for an industrial node on the Chennai–Bengaluru Industrial Corridor.</p>',
                'solution' => '<p>WaterFirst supports EPC-phase engineering for the 2.5 MLD CETP, coordinating treatment, civil and multidisciplinary deliverables.</p>',
                'result' => '<p>The Phase A package provides a coordinated technical basis for industrial effluent management at the Tumakuru node.</p>',
            ],
            [
                'title' => 'STP + 15-Year O&M — Garden Reach, Kolkata',
                'slug' => 'stp-15-year-om-garden-reach-kolkata',
                'client_name' => 'NMCG / Kolkata Municipal Corporation · Hybrid-annuity PPP · Ongoing',
                'category' => 'Operations & Maintenance',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Combine treatment delivery with long-term performance responsibility under a hybrid-annuity public-private model.</p>',
                'solution' => '<p>Engineering and operational inputs for a sewage treatment asset at Garden Reach with a 15-year O&amp;M commitment.</p>',
                'result' => '<p>The ongoing programme aligns design decisions with measurable long-term operating performance.</p>',
            ],
            [
                'title' => '100 & 500 KLD Waste Stabilization Ponds',
                'slug' => 'waste-stabilization-ponds-sbm-washi',
                'client_name' => 'Swachh Bharat Mission 2.0 / WASHI',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Provide robust, low-energy sanitation treatment suited to smaller communities and local operating capacity.</p>',
                'solution' => '<p>Engineering of waste stabilization pond systems at 100 KLD and 500 KLD capacities.</p>',
                'result' => '<p>The designs support simple, sustainable treatment aligned with Swachh Bharat Mission 2.0 objectives.</p>',
            ],
            [
                'title' => 'Sewerage Network Design — Chunar & Dhenkanal',
                'slug' => 'sewerage-network-design-chunar-dhenkanal',
                'client_name' => 'Chunar, Mirzapur UP · Dhenkanal, Odisha',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Plan reliable sewer collection for two growing urban areas with distinct terrain and network conditions.</p>',
                'solution' => '<p>Hydraulic and infrastructure design for sewerage networks in Chunar and Dhenkanal.</p>',
                'result' => '<p>The assignments provide coordinated network layouts and design inputs for municipal sanitation delivery.</p>',
            ],
            [
                'title' => 'UASB Wastewater Treatment — Paper Production, Iraq',
                'slug' => 'uasb-wastewater-treatment-paper-production-iraq',
                'client_name' => 'Al-Shomokh Co / Paper Production Ltd. · Via Krofta Engineering · Iraq',
                'category' => 'Detailed Engineering',
                'industry' => 'pulp-paper',
                'challenge' => '<p>Treat high-strength paper-production wastewater while recovering value through anaerobic treatment.</p>',
                'solution' => '<p>Process engineering for an upflow anaerobic sludge blanket treatment system suited to the industrial wastewater load.</p>',
                'result' => '<p>The design applies anaerobic treatment to reduce organic loading with potential energy and sludge-management benefits.</p>',
            ],
            [
                'title' => 'BWSSB Trunk Sewers & ISPS — 40, 80, 20 & 13 MLD',
                'slug' => 'bwssb-trunk-sewers-isps-detailed-engineering',
                'client_name' => 'KBR Infratech · Hennur, Rajakanal, Horamavu & Byrathikane',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Coordinate basic and detailed engineering for multiple high-capacity trunk sewer and intermediate pumping station packages.</p>',
                'solution' => '<p>BEP and detailed engineering for 40 MLD Hennur, 80 MLD Rajakanal, 20 MLD Horamavu TSPS and 13 MLD Byrathikane.</p>',
                'result' => '<p>The coordinated packages support critical wastewater conveyance capacity across Bangalore.</p>',
            ],
            [
                'title' => 'DBOT Multi-Village Water Treatment Plants — Karnataka',
                'slug' => 'dbot-multi-village-water-treatment-plants-karnataka',
                'client_name' => 'RDWSB · Fichtner and project partners · Karnataka',
                'category' => 'EPC Support',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Deliver reliable regional drinking-water treatment under DBOT programmes serving multiple villages and source conditions.</p>',
                'solution' => '<p>Engineering support for 20 MLD Jamakhandi / Rabakavi-Banahatti, 36 MLD Karkala / Hebri / Kaup using the Varahi River, and 10 MLD Thirthahalli.</p>',
                'result' => '<p>The three schemes represent 66 MLD of combined multi-village treatment capacity across Bagalkote, Udupi and Shivamogga districts.</p>',
            ],
        ];

        foreach ($projects as $index => $project) {
            $savedCaseStudy = CaseStudy::updateOrCreate(
                ['slug' => $project['slug']],
                [
                    'case_study_category_id' => $categories[$project['category']] ?? null,
                    'industry_id' => $industries[$project['industry']] ?? null,
                    'title' => $project['title'],
                    'client_name' => $project['client_name'],
                    'challenge' => $project['challenge'],
                    'solution' => $project['solution'],
                    'result' => $project['result'],
                    'featured_image' => '',
                    'is_featured' => $index < 3,
                    'is_published' => true,
                    'published_at' => '2026-07-17 00:00:00',
                    'order' => $index + 1,
                    'cta_title' => 'Plan a water project with WaterFirst',
                    'cta_text' => 'Bring us into the work from concept design through detailed engineering, delivery support or operations.',
                    'cta_link' => null,
                ]
            );

            $metaDescription = strip_tags($project['solution']);

            SeoMeta::updateOrCreate(
                ['seoable_type' => CaseStudy::class, 'seoable_id' => $savedCaseStudy->id],
                [
                    'meta_title' => $project['title'].' | WaterFirst',
                    'meta_description' => $metaDescription,
                    'meta_keywords' => null,
                    'canonical_url' => null,
                    'og_title' => $project['title'],
                    'og_description' => $metaDescription,
                    'og_image' => null,
                    'twitter_title' => $project['title'],
                    'twitter_description' => $metaDescription,
                    'twitter_image' => null,
                    'schema_json' => null,
                    'robots' => 'index,follow',
                ]
            );
        }

        CaseStudy::query()
            ->whereIn('slug', [
                'highway-expansion-interchange-optimization',
                'smart-urban-district-development',
                'lng-terminal-structural-process-engineering',
                'transform-water-networks-with-intelligent-engineering',
                'build-resilient-infrastructure-for-future-cities',
                'design-smarter-commercial-infrastructure',
                'strengthen-urban-resilience-with-smart-flood-management',
                'accelerate-the-future-of-renewable-energy',
                'advance-renewable-energy-through-intelligent-engineering',
                'create-smarter-and-more-connected-urban-mobility-networks',
                'build-the-cities-of-tomorrow',
                'strengthen-infrastructure-through-advanced-geotechnical-engineering',
                'powering-energy-infrastructure-through-advanced-engineering',
                'transform-land-into-development-ready-communities',
                'transform-existing-facilities-into-intelligent-digital-assets',
                'design-smarter-sustainable-buildings-for-the-future',
                'build-better-projects-with-accurate-geospatial-intelligence',
                'delivering-smarter-roads-and-future-ready-highways',
            ])
            ->update(['is_featured' => false, 'is_published' => false]);
    }
}
