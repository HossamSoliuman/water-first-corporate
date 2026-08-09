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
                'client_name' => 'End client: JSW-JFE Steel Limited · Status: Ongoing',
                'category' => 'Advisory & Studies',
                'industry' => 'steel-heavy-industry',
                'challenge' => '<p>Provide onsite and offsite environmental advisory and expert services for a major steel operation.</p>',
                'solution' => '<p>WaterFirst provides focused environmental advisory, technical review and expert support aligned with the client’s operating priorities.</p>',
                'result' => '<p>The consultancy engagement is ongoing for JSW-JFE Steel Limited.</p>',
                'is_featured' => true,
            ],
            [
                'title' => '3.0 MLD Decentralized STP — Kenchenahalli / Pattangere Lake',
                'slug' => '3-mld-decentralized-stp-kenchenahalli-pattangere-lake',
                'client_name' => 'End client: BWSSB, Bangalore · Status: Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'waterbody-rejuvenation',
                'challenge' => '<p>Develop a decentralized sewage treatment solution at the inlet of Kenchenahalli / Pattangere Lake in Bangalore.</p>',
                'solution' => '<p>WaterFirst prepared the preliminary and detailed project report for a 3.0 MLD decentralized sewage treatment plant.</p>',
                'result' => '<p>The engineering consultancy assignment for BWSSB was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '1.0 MLD Decentralized STP — Mantri Square, Malleshwaram',
                'slug' => '1-mld-decentralized-stp-mantri-square-malleshwaram',
                'client_name' => 'End client: BWSSB, Bangalore · Status: Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Develop a decentralized treatment solution near Mantri Square Mall in Malleshwaram, Bangalore.</p>',
                'solution' => '<p>WaterFirst prepared the preliminary and detailed project report for a 1.0 MLD decentralized sewage treatment plant.</p>',
                'result' => '<p>The engineering consultancy assignment for BWSSB was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '3.0 MLD Decentralized STP — Subramanyapura ISPS',
                'slug' => '3-mld-decentralized-stp-subramanyapura-isps',
                'client_name' => 'End client: BWSSB, Bangalore · Status: Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Develop decentralized sewage treatment at the Subramanyapura intermediate sewage pumping station in Bangalore.</p>',
                'solution' => '<p>WaterFirst prepared the preliminary and detailed project report for a 3.0 MLD decentralized sewage treatment plant.</p>',
                'result' => '<p>The engineering consultancy assignment for BWSSB was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '3.0 MLD Decentralized STP — BDA Sculpture Park',
                'slug' => '3-mld-decentralized-stp-bda-sculpture-park',
                'client_name' => 'End client: BWSSB, Bangalore · Status: Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Develop a decentralized sewage treatment solution for the BDA Sculpture Park site in Bangalore.</p>',
                'solution' => '<p>WaterFirst prepared the preliminary and detailed project report for a 3.0 MLD decentralized sewage treatment plant.</p>',
                'result' => '<p>The engineering consultancy assignment for BWSSB was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '2.5 MLD CETP — Tumakuru CBIC Node',
                'slug' => '2-5-mld-cetp-tumakuru-cbic-node',
                'client_name' => 'Consultant: Assystem STUP · Contractor: L&T · End client: KIADB, Bangalore · Status: Completed',
                'category' => 'EPC Support',
                'industry' => 'industrial-effluent-cetp',
                'challenge' => '<p>Deliver common effluent treatment infrastructure for Phase A of the Tumakuru node on the Chennai–Bengaluru Industrial Corridor.</p>',
                'solution' => '<p>WaterFirst supported the design, construction, testing, commissioning and operation and maintenance works for the 2.5 MLD CETP on an EPC basis.</p>',
                'result' => '<p>The assignment for KIADB was completed with Assystem STUP and L&T.</p>',
                'is_featured' => true,
            ],
            [
                'title' => 'STP + 15-Year O&M — Garden Reach, Kolkata',
                'slug' => 'stp-15-year-om-garden-reach-kolkata',
                'client_name' => 'Consultant: Fichtner · End client: NMCG / KMC · Status: Ongoing',
                'category' => 'Operations & Maintenance',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Develop sewage treatment infrastructure at Garden Reach, Kolkata, with long-term operating responsibility under a hybrid-annuity public-private partnership.</p>',
                'solution' => '<p>The project covers development of the STP and associated infrastructure, followed by operation and maintenance of all assets for 15 years.</p>',
                'result' => '<p>The National Mission for Clean Ganga and Kolkata Municipal Corporation programme is ongoing.</p>',
                'is_featured' => true,
            ],
            [
                'title' => '100 & 500 KLD Waste Stabilization Ponds',
                'slug' => 'waste-stabilization-ponds-sbm-washi',
                'client_name' => 'Consultant: WASHI (NGO) · End client: Swachh Bharat Mission 2.0 · Status: Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Provide low-energy wastewater treatment appropriate for smaller settlements and local operating conditions.</p>',
                'solution' => '<p>WaterFirst delivered detailed engineering support for waste stabilization ponds at 100 KLD and 500 KLD capacities.</p>',
                'result' => '<p>The assignment for Swachh Bharat Mission 2.0 through WASHI was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => 'Sewerage Network Design — Chunar, Uttar Pradesh',
                'slug' => 'sewerage-network-design-chunar',
                'client_name' => 'Consultant: WASHI (NGO) · End client: Swachh Bharat Mission 2.0 · Status: Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Develop a coordinated sewerage network design for Chunar town in Mirzapur district.</p>',
                'solution' => '<p>WaterFirst delivered sewerage network design and detailing for the town.</p>',
                'result' => '<p>The network design assignment was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => 'Sewerage Network Design — Dhenkanal, Odisha',
                'slug' => 'sewerage-network-design-dhenkanal',
                'client_name' => 'Consultant: WASHI (NGO) · End client: Swachh Bharat Mission 2.0 · Status: Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Develop a coordinated sewerage network design for Dhenkanal in Odisha.</p>',
                'solution' => '<p>WaterFirst delivered sewerage network design and detailing for the city.</p>',
                'result' => '<p>The network design assignment was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => 'UASB Wastewater Treatment — Paper Production, Iraq',
                'slug' => 'uasb-wastewater-treatment-paper-production-iraq',
                'client_name' => 'Client: Krofta Engineering Ltd. · End client: Al-Shomokh Co / Paper Production Ltd., Iraq · Status: Completed',
                'category' => 'Detailed Engineering',
                'industry' => 'pulp-paper',
                'challenge' => '<p>Develop an anaerobic treatment solution for wastewater generated by a paper production facility in Iraq.</p>',
                'solution' => '<p>WaterFirst delivered detailed engineering for wastewater treatment based on upflow anaerobic sludge blanket technology.</p>',
                'result' => '<p>The assignment through Krofta Engineering Limited was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => 'HSR Layout Trunk Sewer & 15 MLD ISPS',
                'slug' => 'hsr-layout-trunk-sewer-15-mld-isps',
                'client_name' => 'Contractor: KBR Infratech · End client: BWSSB, Bangalore · Status: Ongoing',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Convey sewage from Garvebhavipalya along HSR Layout to Agaram STP and provide intermediate pumping capacity at HSR Layout.</p>',
                'solution' => '<p>WaterFirst is preparing the basic engineering package and detailed engineering for 1000, 1200, 1800 and 2000 mm diameter RCC NP3 sewer pipelines and a 15 MLD ISPS.</p>',
                'result' => '<p>The consultancy assignment through KBR Infratech for BWSSB is ongoing.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '40 MLD Intermediate Sewage Pumping Station — Hennur',
                'slug' => '40-mld-isps-hennur',
                'client_name' => 'Contractor: KBR Infratech · End client: BWSSB, Bangalore · Status: Ongoing',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Develop high-capacity intermediate sewage pumping infrastructure at Hennur in Bangalore.</p>',
                'solution' => '<p>WaterFirst is preparing the basic engineering package and detailed engineering for the 40 MLD ISPS.</p>',
                'result' => '<p>The consultancy assignment through KBR Infratech for BWSSB is ongoing.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '80 MLD Rajakanal ISPS & 20 MLD Horamavu TSPS',
                'slug' => '80-mld-rajakanal-isps-20-mld-horamavu-tsps',
                'client_name' => 'Contractor: KBR Infratech · End client: BWSSB, Bangalore · Status: Ongoing',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Provide coordinated pumping infrastructure for the Rajakanal and Horamavu wastewater systems.</p>',
                'solution' => '<p>WaterFirst is preparing the basic engineering package and detailed engineering for an 80 MLD ISPS at Rajakanal and a 20 MLD terminal sewage pumping station for Horamavu STP.</p>',
                'result' => '<p>The consultancy assignment through KBR Infratech for BWSSB is ongoing.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '13 MLD Terminal Sewage Pumping Station — Byrathikane',
                'slug' => '13-mld-tsps-byrathikane',
                'client_name' => 'Contractor: KBR Infratech · End client: BWSSB, Bangalore · Status: Ongoing',
                'category' => 'Detailed Engineering',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Develop terminal sewage pumping capacity for the Byrathikane wastewater system.</p>',
                'solution' => '<p>WaterFirst is preparing the basic engineering package and detailed engineering for the 13 MLD terminal sewage pumping station.</p>',
                'result' => '<p>The consultancy assignment through KBR Infratech for BWSSB is ongoing.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '20 MLD Multi-Village WTP — Bagalkote District',
                'slug' => '20-mld-wtp-jamakhandi-rabakavi-banahatti',
                'client_name' => 'Consultant: ROOT · Contractor: VEIPL-SPML (JV) · End client: RDWSB, Bangalore · Status: Completed',
                'category' => 'EPC Support',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Provide drinking-water treatment for rural habitations across Jamakhandi and Rabakavi-Banahatti talukas in Bagalkote district.</p>',
                'solution' => '<p>WaterFirst supported the 20 MLD water treatment plant delivered under a design, build, operate and transfer multi-village water supply scheme.</p>',
                'result' => '<p>The RDWSB assignment with ROOT and VEIPL-SPML (JV) was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '36 MLD Multi-Village WTP — Udupi District',
                'slug' => '36-mld-wtp-karkala-hebri-kaup',
                'client_name' => 'Consultant: ROOT · Contractor: SNC · End client: RDWSB, Bangalore · Status: Completed',
                'category' => 'EPC Support',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Provide drinking-water supply to 69 villages and 1,904 enroute habitations across Karkala, Hebri and Kaup talukas in Udupi district.</p>',
                'solution' => '<p>WaterFirst supported the 36 MLD water treatment plant drawing from the Varahi River near KPC Dam under a DBOT multi-village water supply scheme.</p>',
                'result' => '<p>The RDWSB assignment with ROOT and SNC was completed.</p>',
                'is_featured' => false,
            ],
            [
                'title' => '10 MLD Multi-Village WTP — Thirthahalli',
                'slug' => '10-mld-wtp-thirthahalli',
                'client_name' => 'Consultant: ROOT · Contractor: NIPL-TAHAL · End client: RDWSB, Bangalore · Status: Completed',
                'category' => 'EPC Support',
                'industry' => 'municipal-water-sewerage',
                'challenge' => '<p>Provide drinking-water supply to Mulabagilu and 1,616 other habitations of Thirthahalli Taluk in Shivamogga district.</p>',
                'solution' => '<p>WaterFirst supported the 10 MLD water treatment plant delivered under a DBOT multi-village water supply scheme.</p>',
                'result' => '<p>The RDWSB assignment with ROOT and NIPL-TAHAL was completed.</p>',
                'is_featured' => false,
            ],
        ];

        foreach ($projects as $index => $project) {
            $savedCaseStudy = CaseStudy::updateOrCreate(
                ['title' => $project['title']],
                [
                    'case_study_category_id' => $categories[$project['category']] ?? null,
                    'industry_id' => $industries[$project['industry']] ?? null,
                    'slug' => $project['slug'],
                    'client_name' => $project['client_name'],
                    'challenge' => $project['challenge'],
                    'solution' => $project['solution'],
                    'result' => $project['result'],
                    'featured_image' => '',
                    'is_featured' => $project['is_featured'],
                    'is_published' => true,
                    'published_at' => '2026-07-17 00:00:00',
                    'order' => $index + 1,
                    'cta_title' => 'Plan a water project with WaterFirst',
                    'cta_text' => 'Bring us into the work from concept design through detailed engineering, delivery support or operations.',
                    'cta_link' => null,
                ]
            );

            $savedCaseStudy->forceFill(['slug' => $project['slug']])->saveQuietly();

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
                'bwssb-decentralized-stps-bangalore',
                'sewerage-network-design-chunar-dhenkanal',
                'bwssb-trunk-sewers-isps-detailed-engineering',
                'dbot-multi-village-water-treatment-plants-karnataka',
            ])
            ->update(['is_featured' => false, 'is_published' => false]);
    }
}
