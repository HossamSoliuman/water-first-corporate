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
                'name' => 'Water Supply & Distribution Systems',
                'slug' => 'water-supply-distribution-systems',
                'icon' => 'map',
                'short_description' => 'Source-water management, transmission mains, service reservoirs, pumping systems and distribution networks for municipal and multi-village schemes.',
                'description' => '<h2>Water from the source to the service connection</h2><p>WaterFirst plans, models and engineers water supply systems that stay reliable under real demand, real terrain and real operating budgets — from raw-water intake through transmission, storage and distribution.</p><h3>What we deliver</h3><ul><li>Source-water management, intake structures and raw-water conveyance</li><li>Transmission mains, service reservoirs, pumping stations and distribution networks</li><li>Hydraulic network modelling and analysis using WaterGEMS and EPANET</li><li>Waterbody restoration and remediation as part of source and catchment protection</li><li>Multi-village and rural drinking-water supply schemes, including DBOT delivery</li><li>Demand projection, staging and comprehensive master plans for the foreseeable future</li></ul><h3>How we work</h3><ul><li>Survey coordination, soil and water testing, and inception and feasibility studies to derive the optimal solution</li><li>Technology selection matched to geography, land availability, power availability, funding and required water parameters</li><li>Estimation, documentation, life-cycle cost analysis, DPR preparation and tender documentation</li></ul><p>Compliance is designed in, with attention to the latest NGT standards and applicable MoEF&amp;CC and CPCB requirements, so that solutions protect public health without unintended consequences.</p>',
            ],
            [
                'name' => 'Drinking Water Treatment',
                'slug' => 'drinking-water-treatment',
                'icon' => 'sparkles',
                'short_description' => 'Conventional and advanced drinking-water treatment plants for seawater, river water and groundwater sources, including direct and indirect potable reuse.',
                'description' => '<h2>Treatment designed around the source you actually have</h2><p>We pioneer seawater, river-water and groundwater treatment and solutions, selecting conventional or advanced process trains against raw-water quality, land, power and lifecycle cost rather than a standard template.</p><h3>Process scope</h3><ul><li>Conventional and advanced drinking-water treatment process design</li><li>Contaminant removal for industrial and domestic sources</li><li>Direct and indirect potable water reuse schemes</li><li>Water-quality monitoring, compliance strategy and public-health protection</li><li>Multi-village drinking-water supply schemes delivered on DBOT mode</li></ul><h3>Delivered project scale</h3><ul><li>20 MLD WTP for Jamakhandi and Rabakavi-Banahatti talukas, Bagalkote district, Karnataka</li><li>36 MLD WTP for 69 villages across Karkala, Hebri and Kaup talukas from the Varahi river, Udupi district</li><li>10 MLD WTP for Thirthahalli taluk, Shivamogga district</li></ul><p>Every scheme is developed with compliance strategy built in, protecting both public health and the receiving body of water, including flora and fauna.</p>',
            ],
            [
                'name' => 'Sewerage Systems, Networks & Pumping Stations',
                'slug' => 'sewerage-systems-networks-pumping-stations',
                'icon' => 'building-office-2',
                'short_description' => 'Sewerage collection, conveyance and disposal — trunk sewers, town networks, and intermediate and terminal sewage pumping stations.',
                'description' => '<h2>Collection, conveyance and disposal engineered as one network</h2><p>WaterFirst designs sewerage systems covering collection, treatment and disposal, including sludge treatment and reuse, with hydraulic performance verified before construction.</p><h3>Network and pumping engineering</h3><ul><li>Town and city sewerage network design and detailing</li><li>Trunk sewers, including large-diameter RCC NP3 class sewer lines</li><li>Intermediate (ISPS) and terminal (TSPS) sewage pumping stations</li><li>Basic engineering packages (BEP) and detailed engineering for utility clients</li><li>Network modelling and analysis using SewerGEMS and StormCAD</li></ul><h3>Representative scope</h3><ul><li>40 MLD ISPS at Hennur and 80 MLD ISPS at Rajakanal, Bangalore</li><li>20 MLD TSPS for Horamavu STP and 13 MLD TSPS at Byrathikane STP</li><li>Trunk sewer and 15 MLD ISPS from Garvebhavipalya along HSR Layout to Agaram STP</li><li>Sewerage network design and detailing for Chunar (Mirzapur, Uttar Pradesh) and Dhenkanal (Odisha)</li></ul>',
            ],
            [
                'name' => 'Wastewater Treatment — STP, ETP & CETP',
                'slug' => 'wastewater-treatment-stp-etp-cetp',
                'icon' => 'beaker',
                'short_description' => 'Sewage, effluent and common effluent treatment plants, including anaerobic digestion, biogas generation, power generation and compressed biogas.',
                'description' => '<h2>Wastewater treatment with resource recovery designed in</h2><p>Our core competence: process and detailed design of STPs, ETPs and CETPs for municipal and industrial waste, from decentralised units at a lake inlet to industrial-corridor common facilities.</p><h3>Treatment and recovery</h3><ul><li>STP, ETP and CETP process design, hydraulic design and mass balance</li><li>Anaerobic digestion, biogas generation, power generation and compressed biogas (CBG)</li><li>UASB and other high-rate anaerobic technologies for strong industrial effluent</li><li>Waste stabilization ponds and low-energy treatment for smaller settlements</li><li>Sludge treatment and reuse as an integral part of the treatment train</li><li>Long-term operation and maintenance under annuity and PPP structures</li></ul><h3>Representative scope</h3><ul><li>Decentralised STPs of 3.0 MLD at the inlet of Kenchenahalli / Pattangere Lake, 3.0 MLD at Subramanyapura ISPS, 3.0 MLD at BDA Sculpture Park and 1.0 MLD near Mantri Square, Malleshwaram</li><li>2.5 MLD CETP at the Tumakuru node of the Chennai–Bengaluru Industrial Corridor</li><li>STP and 15-year O&amp;M at Garden Reach, Kolkata, under the National Mission for Clean Ganga</li><li>Waste stabilization ponds of 100 KLD and 500 KLD under Swachh Bharat Mission 2.0</li></ul><p>Designs address the latest NGT standards and applicable MoEF&amp;CC and CPCB requirements so that discharge compliance is achievable in operation, not only on paper.</p>',
            ],
            [
                'name' => 'Industrial Wastewater & Process Water',
                'slug' => 'industrial-wastewater-process-water',
                'icon' => 'building-office',
                'short_description' => 'Complex industrial effluent treatment, process-water systems, segregation and reuse strategies for steel, paper, pharma, chemical and energy plants.',
                'description' => '<h2>Complex industrial waste, treated to a usable standard</h2><p>We treat complex industrial wastewater and engineer the process-water systems that feed production, balancing regulatory compliance, water availability and operating cost.</p><h3>Industrial scope</h3><ul><li>Effluent characterisation, segregation, treatment and compliant discharge</li><li>Industrial process-water requirements, including desalination strategies using SWRO and BWRO</li><li>High-rate anaerobic treatment for high-load streams such as pulp and paper effluent</li><li>Water balance, reuse and recovery to reduce fresh-water intake</li><li>Onsite and offsite environment advisory and expert services for heavy industry</li><li>EHS and customer audits for the pharmaceutical and chemical sectors</li></ul><h3>Representative scope</h3><ul><li>Environment advisory and expert services for JSW-JFE Steel Limited</li><li>Detailed engineering of UASB-based wastewater treatment for Al-Shomokh Co, Paper Production Ltd., Iraq</li></ul>',
            ],
            [
                'name' => 'Water Reuse, Recycling & Desalination',
                'slug' => 'water-reuse-recycling-desalination',
                'icon' => 'cube-transparent',
                'short_description' => 'Reuse of treated water to potable and industrial standards, seawater and brackish-water desalination, and high-purity water for green hydrogen plants.',
                'description' => '<h2>Closing the loop between discharge and demand</h2><p>Reuse is treated as a design objective, not an afterthought. We define the end use first, then engineer the treatment train, monitoring and safeguards needed to reach it dependably.</p><h3>Reuse and recovery</h3><ul><li>Reuse of wastewater to achieve potable and drinking-water quality</li><li>Reuse to industrial water requirements, including boiler, cooling and process duties</li><li>Direct and indirect potable reuse schemes with multi-barrier protection</li><li>Fit-for-purpose polishing, storage and distribution of reclaimed water</li></ul><h3>Desalination and high-purity water</h3><ul><li>Seawater reverse osmosis (SWRO) and brackish-water reverse osmosis (BWRO) strategies</li><li>Pretreatment selection, membrane system design and concentrate management</li><li>Water systems for green hydrogen plants, where feed quality drives electrolyser performance</li></ul>',
            ],
            [
                'name' => 'Sludge, Biosolids & Solid Waste Management',
                'slug' => 'sludge-biosolids-solid-waste-management',
                'icon' => 'truck',
                'short_description' => 'Sludge handling, treatment and beneficial reuse, plus practical solutions for municipal and industrial solid-waste management issues.',
                'description' => '<h2>The residuals stream, planned rather than deferred</h2><p>Sludge and solid waste decide whether a treatment plant can actually be operated. We design the handling, treatment and disposal or reuse route alongside the liquid train.</p><h3>Sludge and biosolids</h3><ul><li>Sludge thickening, stabilisation, dewatering and drying</li><li>Anaerobic digestion with biogas and energy recovery from sludge</li><li>Beneficial reuse routes for treated biosolids</li><li>Sludge treatment and reuse integrated with sewerage disposal planning</li></ul><h3>Solid waste</h3><ul><li>Solutions for municipal and industrial solid-waste management issues</li><li>Segregation, handling and disposal strategies for treatment-plant residuals</li><li>Zero-waste-to-landfill pathways developed with the facility operating team</li></ul>',
            ],
            [
                'name' => 'Sustainability, ESG & Climate Disclosure',
                'slug' => 'sustainability-esg-climate-disclosure',
                'icon' => 'chart-bar',
                'short_description' => 'Sustainability strategy and reporting, ESG and BRSR preparation, climate-change disclosure, carbon footprinting and supply-chain decarbonisation.',
                'description' => '<h2>Disclosure that stands up to scrutiny</h2><p>WaterFirst supports organisations in setting sustainability direction and then reporting on it with evidence their auditors, regulators and investors can follow.</p><h3>Sustainability reporting</h3><ul><li>Developing sustainability strategies</li><li>Sustainability reporting</li><li>ESG reporting</li><li>Preparing the Business Responsibility and Sustainability Report (BRSR)</li></ul><h3>Climate-change disclosures</h3><ul><li>Climate-change reporting</li><li>Carbon footprint assessment, risk identification and adaptation strategies</li><li>Supply-chain decarbonisation</li></ul>',
            ],
            [
                'name' => 'Water Audit, EHS & Environmental Assessment',
                'slug' => 'water-audit-ehs-environmental-assessment',
                'icon' => 'shield-check',
                'short_description' => 'Water audits and water-neutrality assessment, zero-waste-to-landfill audits, EHS and customer audits, EIA and ESA.',
                'description' => '<h2>Find the gap, then close it</h2><p>Audit and assessment work is delivered as an engineering exercise: measure the system, identify where it leaks value or compliance, and recommend changes the site can implement.</p><h3>Water audit and water neutrality</h3><ul><li>Calculation of the water balance across the facility</li><li>Identification of water losses and gap analysis</li><li>Recommendations to improve water utilisation</li><li>Water-neutrality assessment</li></ul><h3>Zero waste to landfill and EHS</h3><ul><li>Comprehensive zero-waste-to-landfill (ZWL) audits and recommendations across industries</li><li>Customer audits (EHS) that identify and correct compliance issues, improve workplace safety and reduce facility and personal liability</li><li>EHS audits offered as part of customer audits to the pharmaceutical and chemical sectors</li><li>Opportunities to improve the efficiency and cost-effectiveness of the compliance programme</li></ul><h3>EIA and ESA</h3><ul><li>Environmental Impact Assessment, the statutory requirement for environmental clearance prescribed by MoEF&amp;CC, for new projects as well as expansion and modernisation projects</li><li>Environmental and Social Assessment of a programme or project prior to the decision to move forward</li><li>Environmental risk assessment and water-quality monitoring</li><li>In-depth support on complex regulatory compliance, including the latest NGT standards</li></ul>',
            ],
            [
                'name' => 'Detailed Engineering & Design',
                'slug' => 'detailed-engineering-design',
                'icon' => 'pencil-square',
                'short_description' => 'Basic engineering packages through detailed process, mechanical, piping, electrical, instrumentation and PLC automation design.',
                'description' => '<h2>Engineering complete enough to build from</h2><p>Concept design and FEED through to issued-for-construction documentation, with process, mechanical, electrical, instrumentation and control automation coordinated by one team.</p><h3>Basic engineering package</h3><ul><li>Process design and hydraulic design</li><li>Layout plan and hydraulic flow diagram</li><li>Mass balance, equipment list and line sizing</li><li>Electrical load list</li></ul><h3>Electro-mechanical and piping</h3><ul><li>Preparation of purchase requisition (PR) sheets for mechanical equipment</li><li>Piping and instrumentation diagrams (P&amp;ID), PFD and civil / mechanical GAD</li><li>Piping layout and isometric drawings</li></ul><h3>Instrumentation and control</h3><ul><li>Instrument index, datasheets and hook-up drawings</li><li>PLC I/O list, system architecture and control-room layout</li><li>Instrument cable schedule and control automation design</li></ul><h3>Plant electrical design and drawings</h3><ul><li>Single line diagram, cable schedule and cable tray layout</li><li>Lighting and earthing layouts</li><li>Transformer sizing and inputs to the vendor for DG sizing calculations</li><li>BOQ for electrical cable, cable tray and allied items, and MCC room panel layout</li></ul><p>Engineering calculations, BOQ and costing cover both conventional and advanced process designs.</p>',
            ],
            [
                'name' => 'DPR, Tender & Procurement Support',
                'slug' => 'dpr-tender-procurement-support',
                'icon' => 'clipboard-document-list',
                'short_description' => 'Feasibility studies, detailed project reports, tender volumes, pre-bid support, technical bid evaluation and procurement of equipment and contractors.',
                'description' => '<h2>Documents that get a project funded, tendered and awarded</h2><p>We prepare the technical and commercial record a client needs to make a defensible decision — and to defend it afterwards.</p><h3>Support for DPR preparation</h3><ul><li>Survey, soil and water testing, market study of the latest applicable technologies</li><li>Recommendations and guidelines to design and construct water and wastewater treatment plants</li><li>Design documents and drawings, civil quantities, mechanical equipment list, piping and valves list, electrical load list and BOQ, instrumentation list and BOQ</li><li>Technical comparison among technologies and proposal of a suitable technology based on geography, land availability, power availability, fund availability and required treated-water parameters</li><li>Estimation, documentation and life-cycle cost analysis</li></ul><h3>Support for tender preparation</h3><ul><li>Preparation of tender technical specifications and commercial conditions</li><li>Preparation of tender volumes including drawings and the price-bid volume to check CAPEX, OPEX and life-cycle cost</li><li>Arranging pre-bid meetings and preparing pre-bid replies</li><li>Evaluation of tenders received from vendors and among bids received from contractors</li><li>Life-cycle cost analysis for each contractor bid and preparation of justifications</li></ul><h3>Procurement</h3><ul><li>Preparation of RFQ and purchase requisitions</li><li>Recommendation of approved equipment and suppliers</li><li>Vendor coordination and technical bid evaluation</li></ul>',
            ],
            [
                'name' => 'Project Management, Operations & Maintenance',
                'slug' => 'project-management-operations-maintenance',
                'icon' => 'cog-6-tooth',
                'short_description' => 'Project management consultancy, EPC coordination and execution support, plus O&M, troubleshooting and performance optimisation of treatment plants.',
                'description' => '<h2>Ownership from award through steady-state operation</h2><p>Engineering only counts once the plant runs. We stay involved through construction, commissioning and operation so performance is proven, not assumed.</p><h3>Project management consultancy</h3><ul><li>Coordination with purchase, EPC and PMC teams</li><li>Project execution services to keep the project within time and budget</li><li>Change-order management and review of customer expectations</li><li>Stakeholder management to arrive at amicable solutions</li><li>Environmental risk assessment and assistance with regulatory compliance, including NGT guidelines</li><li>Fine-tuning of each and every component of the plant</li></ul><h3>Operation and maintenance</h3><ul><li>Operation and maintenance of water and wastewater treatment plants, including long-term contracts such as 15-year O&amp;M under hybrid-annuity PPP</li><li>O&amp;M advisory to ensure regulatory compliance, safety and optimisation</li><li>Onsite support in troubleshooting</li><li>Chemical conditioning and solutions</li><li>System audit and performance benchmarking</li><li>Manpower development and training</li></ul>',
            ],
        ];

        $currentSlugs = array_column($services, 'slug');

        $retiredServiceIds = Service::query()->whereNotIn('slug', $currentSlugs)->pluck('id');

        if ($retiredServiceIds->isNotEmpty()) {
            SeoMeta::query()
                ->where('seoable_type', Service::class)
                ->whereIn('seoable_id', $retiredServiceIds)
                ->delete();

            Service::query()->whereIn('id', $retiredServiceIds)->delete();
        }

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

        Cache::forget('footer_services');
    }
}
