<?php

namespace Database\Seeders;

use App\Models\SeoMeta;
use App\Models\Service;
use Database\Seeders\Concerns\BuildsRichContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class ServiceSeeder extends Seeder
{
    use BuildsRichContent;

    public function run(): void
    {
        $services = [
            [
                'name' => 'Water Supply & Distribution Systems',
                'slug' => 'water-supply-distribution-systems',
                'icon' => 'map',
                'short_description' => 'Source-water management, transmission mains, service reservoirs, pumping systems and distribution networks for municipal and multi-village schemes.',
                'description' => $this->waterSupplyContent(),
            ],
            [
                'name' => 'Drinking Water Treatment',
                'slug' => 'drinking-water-treatment',
                'icon' => 'sparkles',
                'short_description' => 'Conventional and advanced drinking-water treatment plants for seawater, river water and groundwater sources, including direct and indirect potable reuse.',
                'description' => $this->drinkingWaterContent(),
            ],
            [
                'name' => 'Sewerage Systems, Networks & Pumping Stations',
                'slug' => 'sewerage-systems-networks-pumping-stations',
                'icon' => 'building-office-2',
                'short_description' => 'Sewerage collection, conveyance and disposal — trunk sewers, town networks, and intermediate and terminal sewage pumping stations.',
                'description' => $this->sewerageContent(),
            ],
            [
                'name' => 'Wastewater Treatment — STP, ETP & CETP',
                'slug' => 'wastewater-treatment-stp-etp-cetp',
                'icon' => 'beaker',
                'short_description' => 'Sewage, effluent and common effluent treatment plants, including anaerobic digestion, biogas generation, power generation and compressed biogas.',
                'description' => $this->wastewaterTreatmentContent(),
            ],
            [
                'name' => 'Industrial Wastewater & Process Water',
                'slug' => 'industrial-wastewater-process-water',
                'icon' => 'building-office',
                'short_description' => 'Complex industrial effluent treatment, process-water systems, segregation and reuse strategies for steel, paper, pharma, chemical and energy plants.',
                'description' => $this->industrialWaterContent(),
            ],
            [
                'name' => 'Water Reuse, Recycling & Desalination',
                'slug' => 'water-reuse-recycling-desalination',
                'icon' => 'cube-transparent',
                'short_description' => 'Reuse of treated water to potable and industrial standards, seawater and brackish-water desalination, and high-purity water for green hydrogen plants.',
                'description' => $this->reuseDesalinationContent(),
            ],
            [
                'name' => 'Sludge, Biosolids & Solid Waste Management',
                'slug' => 'sludge-biosolids-solid-waste-management',
                'icon' => 'truck',
                'short_description' => 'Sludge handling, treatment and beneficial reuse, plus practical solutions for municipal and industrial solid-waste management issues.',
                'description' => $this->sludgeSolidWasteContent(),
            ],
            [
                'name' => 'Sustainability, ESG & Climate Disclosure',
                'slug' => 'sustainability-esg-climate-disclosure',
                'icon' => 'chart-bar',
                'short_description' => 'Sustainability strategy and reporting, ESG and BRSR preparation, climate-change disclosure, carbon footprinting and supply-chain decarbonisation.',
                'description' => $this->sustainabilityContent(),
            ],
            [
                'name' => 'Water Audit, EHS & Environmental Assessment',
                'slug' => 'water-audit-ehs-environmental-assessment',
                'icon' => 'shield-check',
                'short_description' => 'Water audits and water-neutrality assessment, zero-waste-to-landfill audits, EHS and customer audits, EIA and ESA.',
                'description' => $this->auditAssessmentContent(),
            ],
            [
                'name' => 'Detailed Engineering & Design',
                'slug' => 'detailed-engineering-design',
                'icon' => 'pencil-square',
                'short_description' => 'Basic engineering packages through detailed process, mechanical, piping, electrical, instrumentation and PLC automation design.',
                'description' => $this->detailedEngineeringContent(),
            ],
            [
                'name' => 'DPR, Tender & Procurement Support',
                'slug' => 'dpr-tender-procurement-support',
                'icon' => 'clipboard-document-list',
                'short_description' => 'Feasibility studies, detailed project reports, tender volumes, pre-bid support, technical bid evaluation and procurement of equipment and contractors.',
                'description' => $this->dprTenderContent(),
            ],
            [
                'name' => 'Project Management, Operations & Maintenance',
                'slug' => 'project-management-operations-maintenance',
                'icon' => 'cog-6-tooth',
                'short_description' => 'Project management consultancy, EPC coordination and execution support, plus O&M, troubleshooting and performance optimisation of treatment plants.',
                'description' => $this->projectManagementContent(),
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
                    'featured_image' => "services/{$service['slug']}_medium.webp",
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

    private function waterSupplyContent(): string
    {
        return $this->richLead('Water supply fails at the weakest link, not the biggest one. WaterFirst plans, models and engineers supply systems that hold up under real demand, real terrain and real operating budgets — from the raw-water intake through transmission, storage and every service connection at the end of the line.')
            .$this->richStats([
                ['value' => '3', 'label' => 'Multi-village schemes delivered'],
                ['value' => '66 MLD', 'label' => 'Combined scheme capacity'],
                ['value' => '69', 'label' => 'Villages served, Udupi district'],
                ['value' => 'DBOT', 'label' => 'Delivery mode supported'],
            ])
            .$this->richHeading('Scope', 'From the source to the service connection')
            .$this->richChecklist([
                'Source-water management, intake structures and raw-water conveyance',
                'Transmission mains, service reservoirs and pumping stations',
                'Distribution network design, zoning and staged commissioning',
                'Hydraulic network modelling and analysis in WaterGEMS and EPANET',
                'Waterbody restoration and remediation as catchment protection',
                'Multi-village and rural drinking-water schemes, including DBOT delivery',
                'Demand projection, staging and comprehensive master planning',
                'Non-revenue water reduction built into network zoning decisions',
            ])
            .$this->richHeading('Method', 'How a scheme takes shape')
            .$this->richSteps([
                [
                    'title' => 'Survey, testing and feasibility',
                    'body' => 'Topographic survey coordination, soil and water testing, and inception and feasibility studies that establish what the catchment can actually supply.',
                ],
                [
                    'title' => 'Demand projection and staging',
                    'body' => 'Population and demand projected across the design horizon, then broken into stages the client can fund and commission in sequence.',
                ],
                [
                    'title' => 'Hydraulic modelling',
                    'body' => 'Network analysis under peak, fire and low-demand conditions so residual pressures, surge and pump duty points are proven before anything is procured.',
                ],
                [
                    'title' => 'Technology and estimation',
                    'body' => 'Technology matched to geography, land, power, funding and required water parameters — closed out with estimation, life-cycle cost analysis, DPR and tender documentation.',
                ],
            ])
            .$this->richChips('Modelling and design tools', ['WaterGEMS', 'EPANET', 'AutoCAD', 'Civil 3D', 'GIS'])
            .$this->richCallout('Compliance by design', 'Schemes are developed against the latest NGT standards and applicable MoEF&amp;CC and CPCB requirements, so a solution that protects public health does not create a second problem downstream.')
            .$this->richClosing('Share the source, the service area and the delivery model, and we will frame the transmission, storage and distribution strategy around them.');
    }

    private function drinkingWaterContent(): string
    {
        return $this->richLead('There is no standard treatment plant, because there is no standard raw water. We pioneer seawater, river-water and groundwater treatment by selecting the process train against the source you actually have — measured against land, power and lifecycle cost rather than a template.')
            .$this->richStats([
                ['value' => '36 MLD', 'label' => 'Varahi river WTP, Udupi'],
                ['value' => '20 MLD', 'label' => 'WTP, Bagalkote district'],
                ['value' => '10 MLD', 'label' => 'WTP, Shivamogga district'],
                ['value' => '69', 'label' => 'Villages on one scheme'],
            ])
            .$this->richHeading('Process scope', 'Conventional trains and advanced barriers')
            .$this->richCards([
                [
                    'title' => 'Conventional treatment',
                    'body' => 'Aeration, coagulation, flocculation, clarification, filtration and disinfection sized for the seasonal swing in raw-water quality.',
                ],
                [
                    'title' => 'Advanced processes',
                    'body' => 'Membrane and adsorption-based barriers where the source carries contaminants a conventional train cannot reliably remove.',
                ],
                [
                    'title' => 'Contaminant removal',
                    'body' => 'Targeted removal for industrial and domestic sources, driven by the parameters the treated water has to meet in service.',
                ],
                [
                    'title' => 'Potable reuse',
                    'body' => 'Direct and indirect potable reuse schemes designed with multiple independent barriers and monitoring at each one.',
                ],
            ])
            .$this->richHeading('Delivered capacity', 'Multi-village schemes on DBOT mode', 3)
            .$this->richTable(
                ['Capacity', 'Scheme', 'Source and district'],
                [
                    ['36 MLD', 'Water treatment plant serving 69 villages across Karkala, Hebri and Kaup talukas', 'Varahi river, Udupi district'],
                    ['20 MLD', 'Water treatment plant for Jamakhandi and Rabakavi-Banahatti talukas', 'Bagalkote district, Karnataka'],
                    ['10 MLD', 'Water treatment plant for Thirthahalli taluk', 'Shivamogga district, Karnataka'],
                ]
            )
            .$this->richHeading('Assurance', 'Water quality that holds in operation', 3)
            .$this->richChecklist([
                'Water-quality monitoring plans matched to the risk profile of the source',
                'Compliance strategy set out before the process train is fixed',
                'Operator-facing control philosophy, so quality survives shift changes',
                'Public-health protection treated as the design constraint, not the outcome',
            ])
            .$this->richCallout('Downstream responsibility', 'Every scheme is developed to protect public health and the receiving body of water, including its flora and fauna. Abstraction and residuals are planned together with treatment.')
            .$this->richClosing('Send us a raw-water analysis and a target output, and we will come back with the process options worth comparing.');
    }

    private function sewerageContent(): string
    {
        return $this->richLead('Collection, conveyance and disposal only work as one system. WaterFirst designs sewerage networks and the pumping stations that carry them, with hydraulic performance verified in the model before it is committed to concrete.')
            .$this->richStats([
                ['value' => '80 MLD', 'label' => 'Rajakanal ISPS, Bangalore'],
                ['value' => '40 MLD', 'label' => 'Hennur ISPS, Bangalore'],
                ['value' => '20 MLD', 'label' => 'Horamavu TSPS'],
                ['value' => '13 MLD', 'label' => 'Byrathikane TSPS'],
            ])
            .$this->richHeading('Network engineering', 'Gravity where possible, pumped where necessary')
            .$this->richChecklist([
                'Town and city sewerage network design and detailing',
                'Trunk sewers, including large-diameter RCC NP3 class sewer lines',
                'Intermediate sewage pumping stations (ISPS)',
                'Terminal sewage pumping stations (TSPS)',
                'Basic engineering packages (BEP) for utility clients',
                'Detailed engineering through to issued-for-construction drawings',
                'Network modelling and analysis in SewerGEMS and StormCAD',
                'Wet-well sizing, surge review and pump duty selection',
            ])
            .$this->richHeading('Track record', 'Pumping stations and trunk sewers in service', 3)
            .$this->richTable(
                ['Capacity', 'Asset', 'Client'],
                [
                    ['80 MLD', 'Intermediate sewage pumping station, Rajakanal', 'BWSSB, Bangalore'],
                    ['40 MLD', 'Intermediate sewage pumping station, Hennur', 'BWSSB, Bangalore'],
                    ['20 MLD', 'Terminal sewage pumping station, Horamavu STP', 'BWSSB, Bangalore'],
                    ['15 MLD', 'Trunk sewer and ISPS, Garvebhavipalya to Agaram STP via HSR Layout', 'BWSSB, Bangalore'],
                    ['13 MLD', 'Terminal sewage pumping station, Byrathikane STP', 'BWSSB, Bangalore'],
                ]
            )
            .$this->richHeading('Beyond Bangalore', 'Town networks under Swachh Bharat Mission 2.0', 3)
            .$this->richParagraph('Sewerage network design and detailing has been delivered for Chunar in Mirzapur, Uttar Pradesh, and for Dhenkanal in Odisha — smaller towns where affordability, phasing and buildability decide whether a network is ever completed.')
            .$this->richChips('Modelling and drafting', ['SewerGEMS', 'StormCAD', 'AutoCAD', 'Civil 3D', 'GIS'])
            .$this->richClosing('Bring the catchment, the terrain and the discharge point. We will tell you where the network wants to go.');
    }

    private function wastewaterTreatmentContent(): string
    {
        return $this->richLead('This is our core competence: process and detailed design of STPs, ETPs and CETPs for municipal and industrial waste — from a decentralised unit at a lake inlet to a common facility serving an entire industrial corridor, with resource recovery designed in rather than bolted on.')
            .$this->richStats([
                ['value' => '10 MLD', 'label' => 'Decentralised STP capacity, Bangalore'],
                ['value' => '2.5 MLD', 'label' => 'CETP, Tumakuru CBIC node'],
                ['value' => '15 yr', 'label' => 'O&amp;M, Garden Reach, Kolkata'],
                ['value' => '500 KLD', 'label' => 'Waste stabilization pond'],
            ])
            .$this->richHeading('Treatment', 'Process design that an operator can actually run')
            .$this->richChecklist([
                'STP, ETP and CETP process design, hydraulic design and mass balance',
                'UASB and other high-rate anaerobic technologies for strong effluent',
                'Waste stabilization ponds and low-energy treatment for small settlements',
                'Decentralised treatment placed at the source of the pollution load',
                'Sludge treatment and reuse as part of the same train, not an afterthought',
                'Long-term operation and maintenance under annuity and PPP structures',
            ])
            .$this->richHeading('Recovery', 'Energy and value from the waste stream', 3)
            .$this->richCards([
                [
                    'title' => 'Anaerobic digestion',
                    'body' => 'Stabilises sludge and converts organic load into a usable gas stream instead of a disposal cost.',
                ],
                [
                    'title' => 'Biogas and power',
                    'body' => 'On-site power generation that offsets the plant load, sized against realistic gas yield rather than nameplate optimism.',
                ],
                [
                    'title' => 'Compressed biogas',
                    'body' => 'Upgrading to CBG where offtake exists, turning a treatment plant into a fuel producer.',
                ],
                [
                    'title' => 'Treated water reuse',
                    'body' => 'Fit-for-purpose polishing so the effluent leaves as a resource for irrigation, industry or recharge.',
                ],
            ])
            .$this->richHeading('Representative scope', 'Municipal, industrial and mission-mode projects', 3)
            .$this->richTable(
                ['Capacity', 'Project', 'Context'],
                [
                    ['3.0 MLD', 'Decentralised STP at the inlet of Kenchenahalli / Pattangere Lake', 'BWSSB, Bangalore'],
                    ['3.0 MLD', 'Decentralised STP at Subramanyapura ISPS', 'BWSSB, Bangalore'],
                    ['3.0 MLD', 'Decentralised STP at BDA Sculpture Park', 'BWSSB, Bangalore'],
                    ['1.0 MLD', 'Decentralised STP near Mantri Square, Malleshwaram', 'BWSSB, Bangalore'],
                    ['2.5 MLD', 'Common effluent treatment plant, Tumakuru node', 'Chennai–Bengaluru Industrial Corridor, KIADB'],
                    ['—', 'STP with 15-year O&amp;M at Garden Reach', 'National Mission for Clean Ganga, Kolkata'],
                    ['100 &amp; 500 KLD', 'Waste stabilization ponds', 'Swachh Bharat Mission 2.0'],
                ]
            )
            .$this->richCallout('Discharge compliance', 'Designs address the latest NGT standards and applicable MoEF&amp;CC and CPCB requirements so that compliance is achievable in operation — under load, at 3 a.m., with the staff the plant actually has — and not only on paper.')
            .$this->richClosing('Give us the influent characterisation and the discharge standard. We will show you the trains that reach it and what each one costs to run.');
    }

    private function industrialWaterContent(): string
    {
        return $this->richLead('Industrial effluent is a production problem before it is an environmental one. We treat complex waste streams and engineer the process water that feeds the plant, balancing regulatory compliance, water availability and the cost of every cubic metre.')
            .$this->richChips('Sectors served', ['Steel', 'Pulp &amp; Paper', 'Pharmaceutical', 'Chemical', 'Energy', 'Green Hydrogen'])
            .$this->richHeading('Effluent', 'Characterise, segregate, then treat')
            .$this->richSteps([
                [
                    'title' => 'Characterisation',
                    'body' => 'Stream-by-stream sampling to establish load, variability and the constituents that will decide the process, rather than designing to a blended average.',
                ],
                [
                    'title' => 'Segregation',
                    'body' => 'Separating strong, toxic and dilute streams at source so each is treated by the cheapest process that can handle it.',
                ],
                [
                    'title' => 'Treatment and recovery',
                    'body' => 'High-rate anaerobic treatment for high-load streams such as pulp and paper effluent, followed by the polishing the discharge or reuse standard requires.',
                ],
                [
                    'title' => 'Compliant discharge or reuse',
                    'body' => 'Water balance closed across the site, with reuse and recovery reducing fresh-water intake and the volume that needs a discharge consent.',
                ],
            ])
            .$this->richHeading('Process water', 'Feeding production reliably', 3)
            .$this->richChecklist([
                'Industrial process-water requirements defined against production duty',
                'Desalination strategies using SWRO and BWRO where source water is saline',
                'Boiler, cooling and process water quality and conditioning',
                'Water balance, reuse and recovery to cut fresh-water intake',
                'Onsite and offsite environment advisory for heavy industry',
                'EHS and customer audits for the pharmaceutical and chemical sectors',
            ])
            .$this->richHeading('Representative scope', 'Heavy industry and export engineering', 3)
            .$this->richTable(
                ['Client', 'Engagement', 'Status'],
                [
                    ['JSW-JFE Steel Limited', 'Environment advisory and expert services, onsite and offsite', 'Ongoing'],
                    ['Al-Shomokh Co, Paper Production Ltd., Iraq', 'Detailed engineering of UASB-based wastewater treatment, via Krofta Engineering Ltd.', 'Completed'],
                ]
            )
            .$this->richClosing('If your consent conditions are tightening or your water bill is rising faster than production, both usually point at the same untreated stream.');
    }

    private function reuseDesalinationContent(): string
    {
        return $this->richLead('Reuse is a design objective, not a disposal strategy. We define the end use first, then engineer the treatment train, monitoring and safeguards needed to reach it dependably — every day, not on the commissioning run.')
            .$this->richHeading('Reuse', 'Closing the loop between discharge and demand')
            .$this->richCards([
                [
                    'title' => 'To potable quality',
                    'body' => 'Reuse of wastewater to drinking-water standards, with the barrier count and monitoring the risk assessment demands.',
                ],
                [
                    'title' => 'To industrial duty',
                    'body' => 'Reclaimed water conditioned for boiler, cooling and process service, matched to each duty rather than to one blended spec.',
                ],
                [
                    'title' => 'Direct and indirect potable reuse',
                    'body' => 'Multi-barrier schemes with independent failure modes, so no single process step carries the whole public-health risk.',
                ],
                [
                    'title' => 'Storage and distribution',
                    'body' => 'Fit-for-purpose polishing, storage and dedicated distribution of reclaimed water, separated from the potable network.',
                ],
            ])
            .$this->richHeading('Desalination', 'When the only water available is saline', 3)
            .$this->richChecklist([
                'Seawater reverse osmosis (SWRO) strategy and system design',
                'Brackish-water reverse osmosis (BWRO) for inland saline sources',
                'Pretreatment selection driven by the fouling risk of the intake',
                'Membrane system configuration, recovery and energy recovery devices',
                'Concentrate management and discharge planning',
            ])
            .$this->richHeading('High-purity water', 'Green hydrogen and electrolyser feed', 3)
            .$this->richParagraph('Electrolyser performance and stack life depend directly on feed-water quality. We engineer the water systems for green hydrogen plants so that purity, redundancy and recovery are settled at design stage, when they are still cheap to change.')
            .$this->richCallout('The honest constraint', 'Reuse rarely fails on process. It fails on storage, on distribution, and on the monitoring that lets an operator prove quality before the water is used. Those are scoped from the start.')
            .$this->richClosing('Tell us the end use and the volume. The barriers that get you there follow from it.');
    }

    private function sludgeSolidWasteContent(): string
    {
        return $this->richLead('Sludge decides whether a treatment plant can actually be operated. We design the handling, treatment and disposal or reuse route alongside the liquid train, so the residuals stream is planned rather than deferred to the operator.')
            .$this->richHeading('Sludge and biosolids', 'The residuals train, step by step')
            .$this->richSteps([
                [
                    'title' => 'Thickening',
                    'body' => 'Reducing volume early so every downstream unit — and every tanker movement — is sized for a smaller, more consistent stream.',
                ],
                [
                    'title' => 'Stabilisation and digestion',
                    'body' => 'Anaerobic digestion that stabilises the solids and recovers biogas and energy, cutting both odour risk and running cost.',
                ],
                [
                    'title' => 'Dewatering',
                    'body' => 'Mechanical dewatering selected against cake dryness, polymer consumption and what the disposal route will actually accept.',
                ],
                [
                    'title' => 'Drying and beneficial reuse',
                    'body' => 'Routes that turn treated biosolids into a product with a receiver, instead of a residue looking for a landfill.',
                ],
            ])
            .$this->richHeading('Solid waste', 'Practical routes, not aspirational ones', 3)
            .$this->richChecklist([
                'Solutions for municipal and industrial solid-waste management issues',
                'Segregation, handling and disposal strategies for plant residuals',
                'Zero-waste-to-landfill pathways developed with the operating team',
                'Sludge treatment and reuse integrated with sewerage disposal planning',
                'Screenings and grit handling designed for the labour actually available',
            ])
            .$this->richCallout('Why this is scoped early', 'A liquid train sized without its residuals route produces a plant that meets its discharge standard and still cannot run. Sludge quantity, quality and destination are fixed in the same design cycle as the process.')
            .$this->richClosing('If your plant is compliant on paper and struggling on solids, the fix is usually upstream of the dewatering unit.');
    }

    private function sustainabilityContent(): string
    {
        return $this->richLead('Disclosure has to survive scrutiny. WaterFirst helps organisations set a sustainability direction and then report on it with evidence their auditors, regulators and investors can follow back to a source.')
            .$this->richHeading('Reporting', 'Strategy first, then the report')
            .$this->richCards([
                [
                    'title' => 'Sustainability strategy',
                    'body' => 'Developing a direction the business can act on, with targets tied to operational levers rather than to a communications calendar.',
                ],
                [
                    'title' => 'Sustainability reporting',
                    'body' => 'Structured reporting built on measured data, with the boundary and methodology stated plainly.',
                ],
                [
                    'title' => 'ESG reporting',
                    'body' => 'Environmental, social and governance disclosure prepared for the audiences that will actually interrogate it.',
                ],
                [
                    'title' => 'BRSR preparation',
                    'body' => 'Preparation of the Business Responsibility and Sustainability Report against the prescribed format and attributes.',
                ],
            ])
            .$this->richHeading('Climate', 'Footprint, risk and the response', 3)
            .$this->richChecklist([
                'Climate-change reporting and disclosure',
                'Carbon footprint assessment across the defined boundary',
                'Climate risk identification and adaptation strategies',
                'Supply-chain decarbonisation, where most of the footprint usually sits',
                'Water-related disclosure grounded in an actual site water balance',
            ])
            .$this->richHeading('Method', 'How a disclosure cycle runs', 3)
            .$this->richSteps([
                [
                    'title' => 'Boundary and baseline',
                    'body' => 'Agreeing what is in scope and establishing a defensible baseline before any target is announced.',
                ],
                [
                    'title' => 'Measurement',
                    'body' => 'Collecting the operational data the disclosure depends on, and documenting where each number came from.',
                ],
                [
                    'title' => 'Assessment',
                    'body' => 'Footprint, risk and gap analysis against the framework the organisation reports under.',
                ],
                [
                    'title' => 'Disclosure and action',
                    'body' => 'Reporting alongside the adaptation and decarbonisation actions that make the next cycle better than the current one.',
                ],
            ])
            .$this->richCallout('Engineering behind the numbers', 'Our reporting work sits on the same engineering base as our plant design. A water-neutrality claim, a reuse figure or a decarbonisation target can be traced back to a balance we can defend.')
            .$this->richClosing('Whether you are preparing a first BRSR or tightening a fifth one, the constraint is usually data lineage — start there.');
    }

    private function auditAssessmentContent(): string
    {
        return $this->richLead('Audit work is an engineering exercise, not a paperwork one: measure the system, find where it leaks value or compliance, and recommend changes the site can implement with the budget and people it has.')
            .$this->richHeading('Water audit', 'Find the gap, then close it')
            .$this->richSteps([
                [
                    'title' => 'Calculate the water balance',
                    'body' => 'Every inflow, use, loss and discharge across the facility reconciled into one balance that closes.',
                ],
                [
                    'title' => 'Identify losses',
                    'body' => 'Gap analysis that separates real losses from metering error, and quantifies what each is costing.',
                ],
                [
                    'title' => 'Recommend improvements',
                    'body' => 'Prioritised recommendations to improve water utilisation, ranked by payback rather than by ambition.',
                ],
                [
                    'title' => 'Assess water neutrality',
                    'body' => 'Water-neutrality assessment against the balance, so the claim rests on measurement.',
                ],
            ])
            .$this->richHeading('Compliance audits', 'ZWL, EHS and customer audits', 3)
            .$this->richCards([
                [
                    'title' => 'Zero waste to landfill',
                    'body' => 'Comprehensive ZWL audits and recommendations across industries, tracing every stream to a destination.',
                ],
                [
                    'title' => 'EHS and customer audits',
                    'body' => 'Identifying and correcting compliance issues, improving workplace safety and reducing facility and personal liability.',
                ],
                [
                    'title' => 'Pharma and chemical',
                    'body' => 'EHS audits offered as part of customer audits to the pharmaceutical and chemical sectors.',
                ],
                [
                    'title' => 'Programme efficiency',
                    'body' => 'Opportunities to improve the efficiency and cost-effectiveness of the compliance programme itself.',
                ],
            ])
            .$this->richHeading('Assessment', 'EIA, ESA and environmental risk', 3)
            .$this->richChecklist([
                'Environmental Impact Assessment — the statutory requirement for environmental clearance prescribed by MoEF&amp;CC',
                'EIA for new projects as well as expansion and modernisation projects',
                'Environmental and Social Assessment of a programme or project before the decision to proceed',
                'Environmental risk assessment and water-quality monitoring',
                'In-depth support on complex regulatory compliance, including the latest NGT standards',
            ])
            .$this->richCallout('What an audit is for', 'A report that lists findings without a route to closure is a liability, not an asset. Every audit we deliver ends in actions with an owner, a cost and a sequence.')
            .$this->richClosing('Most sites already have the data an audit needs. The work is reconciling it into a balance that closes.');
    }

    private function detailedEngineeringContent(): string
    {
        return $this->richLead('Engineering complete enough to build from. Concept design and FEED through to issued-for-construction documentation, with process, mechanical, piping, electrical, instrumentation and control automation coordinated by one team instead of stitched together at the end.')
            .$this->richHeading('Deliverables', 'What each discipline issues')
            .$this->richTable(
                ['Discipline', 'Deliverables'],
                [
                    ['Process', 'Process design, hydraulic design, mass balance, layout plan, hydraulic flow diagram, equipment list, line sizing'],
                    ['Mechanical', 'Purchase requisition (PR) sheets for mechanical equipment, civil and mechanical GAD, equipment datasheets'],
                    ['Piping', 'P&amp;ID and PFD, piping layout, isometric drawings, valve and specialty schedules'],
                    ['Electrical', 'Single line diagram, load list, cable schedule, cable tray layout, lighting and earthing layouts, transformer sizing, DG sizing inputs, MCC room panel layout'],
                    ['Instrumentation', 'Instrument index, datasheets, hook-up drawings, instrument cable schedule'],
                    ['Automation', 'PLC I/O list, system architecture, control-room layout, control automation design'],
                ]
            )
            .$this->richHeading('Basic engineering package', 'The decisions that fix everything downstream', 3)
            .$this->richChecklist([
                'Process design and hydraulic design',
                'Layout plan and hydraulic flow diagram',
                'Mass balance and equipment list',
                'Line sizing and preliminary hydraulics',
                'Electrical load list',
                'Engineering calculations, BOQ and costing',
            ])
            .$this->richHeading('Sequence', 'Concept to issued-for-construction', 3)
            .$this->richSteps([
                [
                    'title' => 'Concept and FEED',
                    'body' => 'Options narrowed against site constraints, with the cost and operability consequences of each made explicit before commitment.',
                ],
                [
                    'title' => 'Basic engineering package',
                    'body' => 'Process, hydraulics, mass balance, layout and load list frozen as the reference every discipline then works to.',
                ],
                [
                    'title' => 'Detailed engineering',
                    'body' => 'Mechanical, piping, electrical, instrumentation and automation developed in parallel with interface checks at each release.',
                ],
                [
                    'title' => 'Issued for construction',
                    'body' => 'Coordinated drawings, BOQ and specifications a contractor can build from without a running stream of clarifications.',
                ],
            ])
            .$this->richChips('Design environment', ['AutoCAD', 'Civil 3D', 'Revit', 'Plant 3D', 'Mechanical Desktop', 'SolidWorks', 'GIS'])
            .$this->richCallout('Conventional and advanced alike', 'Engineering calculations, BOQ and costing cover both conventional and advanced process designs, so a technology comparison can be made on real quantities rather than on rules of thumb.')
            .$this->richClosing('Bring a BEP that needs completing or a concept that needs taking all the way to IFC — both are familiar ground.');
    }

    private function dprTenderContent(): string
    {
        return $this->richLead('The documents that get a project funded, tendered and awarded. We prepare the technical and commercial record a client needs to make a defensible decision — and to defend it afterwards, when the losing bidder asks why.')
            .$this->richHeading('Sequence', 'From feasibility to award')
            .$this->richSteps([
                [
                    'title' => 'Feasibility and survey',
                    'body' => 'Survey, soil and water testing, and a market study of the latest applicable technologies before options are narrowed.',
                ],
                [
                    'title' => 'DPR preparation',
                    'body' => 'Design documents and drawings, civil quantities, equipment and piping lists, electrical and instrumentation BOQ, estimation and life-cycle cost analysis.',
                ],
                [
                    'title' => 'Tender preparation',
                    'body' => 'Technical specifications, commercial conditions, drawings and the price-bid volume structured to expose CAPEX, OPEX and life-cycle cost.',
                ],
                [
                    'title' => 'Pre-bid and evaluation',
                    'body' => 'Pre-bid meetings and replies, evaluation of tenders received, life-cycle cost analysis of each bid, and written justifications for the recommendation.',
                ],
            ])
            .$this->richHeading('DPR support', 'What goes into the report', 3)
            .$this->richChecklist([
                'Survey, soil and water testing, and market study of applicable technologies',
                'Recommendations and guidelines to design and construct water and wastewater treatment plants',
                'Design documents, drawings and civil quantities',
                'Mechanical equipment list, piping and valves list',
                'Electrical load list and BOQ, instrumentation list and BOQ',
                'Technical comparison among technologies with a recommended option',
                'Estimation, documentation and life-cycle cost analysis',
            ])
            .$this->richCallout('How technology gets chosen', 'A suitable technology is proposed on geography, land availability, power availability, fund availability and the required treated-water parameters — the five constraints that actually decide whether a plant can be built and run at that site.')
            .$this->richHeading('Procurement', 'Equipment and contractors', 3)
            .$this->richChecklist([
                'Preparation of RFQ and purchase requisitions',
                'Recommendation of approved equipment and suppliers',
                'Vendor coordination and technical bid evaluation',
                'Comparison of bids received from contractors on a like-for-like basis',
                'Life-cycle cost analysis per bid, with justifications prepared for record',
            ])
            .$this->richClosing('A tender that is priced clearly is a tender that can be evaluated quickly. Most of that is decided in how the price-bid volume is written.');
    }

    private function projectManagementContent(): string
    {
        return $this->richLead('Engineering only counts once the plant runs. We stay involved through construction, commissioning and operation — including long-term contracts — so that performance is proven rather than assumed.')
            .$this->richStats([
                ['value' => '15 yr', 'label' => 'O&amp;M contract, Garden Reach'],
                ['value' => 'PPP', 'label' => 'Hybrid annuity structure'],
                ['value' => 'NMCG', 'label' => 'National Mission for Clean Ganga'],
            ])
            .$this->richHeading('Project management', 'Keeping delivery inside time and budget')
            .$this->richChecklist([
                'Coordination with purchase, EPC and PMC teams',
                'Project execution services to hold the project to time and budget',
                'Change-order management and review of customer expectations',
                'Stakeholder management to arrive at amicable solutions',
                'Environmental risk assessment and regulatory compliance support, including NGT guidelines',
                'Fine-tuning of each and every component of the plant',
            ])
            .$this->richHeading('Operations', 'What long-term responsibility looks like', 3)
            .$this->richCards([
                [
                    'title' => 'Long-term O&amp;M',
                    'body' => 'Operation and maintenance of water and wastewater treatment plants, including 15-year contracts under hybrid-annuity PPP.',
                ],
                [
                    'title' => 'Compliance and safety',
                    'body' => 'O&amp;M advisory that keeps the plant inside its consent conditions while staying safe to operate.',
                ],
                [
                    'title' => 'Troubleshooting',
                    'body' => 'Onsite support when performance drifts, tracing the cause rather than dosing around the symptom.',
                ],
                [
                    'title' => 'Chemical conditioning',
                    'body' => 'Conditioning and dosing solutions matched to the influent the plant is actually receiving.',
                ],
                [
                    'title' => 'Audit and benchmarking',
                    'body' => 'System audit and performance benchmarking against design intent and comparable plants.',
                ],
                [
                    'title' => 'Manpower development',
                    'body' => 'Training that leaves the operating team able to run the plant without the consultant on site.',
                ],
            ])
            .$this->richCallout('Skin in the game', 'The STP at Garden Reach, Kolkata, is delivered with 15 years of operation and maintenance under the National Mission for Clean Ganga. Designing a plant you will then operate for fifteen years changes the decisions you make at design stage.')
            .$this->richClosing('If a plant is underperforming, we would rather audit it honestly than promise a chemical that hides the problem for a quarter.');
    }
}
