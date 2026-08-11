<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\SeoMeta;
use Database\Seeders\Concerns\BuildsRichContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

/**
 * Editorial content for /insights.
 *
 * Articles are written from WaterFirst's own delivery experience and carry no
 * byline, because author records are pending client input. Bodies are built from
 * the shared inline-CSS blocks so they render correctly inside the `.prose`
 * wrapper, which has no typography plugin behind it.
 */
class BlogSeeder extends Seeder
{
    use BuildsRichContent;

    public function run(): void
    {
        $categories = BlogCategory::pluck('id', 'name');
        $tags = BlogTag::pluck('id', 'name');

        $articles = [
            [
                'title' => 'A compliant treatment plant can still be unrunnable',
                'slug' => 'compliant-treatment-plant-can-still-be-unrunnable',
                'category' => 'Wastewater & Reuse',
                'tags' => ['STP', 'Sludge', 'O&M', 'NGT Standards'],
                'excerpt' => 'Most underperforming STPs were never wrong on process. They were sized without a residuals route, and the liquid train inherited the consequences.',
                'featured_image' => 'services/sludge-biosolids-solid-waste-management_medium.webp',
                'published_at' => '2026-07-28 09:30:00',
                'is_featured' => true,
                'content' => $this->unrunnablePlantArticle(),
            ],
            [
                'title' => 'Reading a raw-water analysis before you choose a process train',
                'slug' => 'reading-a-raw-water-analysis',
                'category' => 'Water Treatment',
                'tags' => ['Process Design', 'Source Water', 'Drinking Water'],
                'excerpt' => 'A single grab sample tells you what the source was doing that morning. Process selection needs to survive the worst week of the year, not the calmest one.',
                'featured_image' => 'images/source-water-intake.jpg',
                'published_at' => '2026-07-14 10:00:00',
                'is_featured' => true,
                'content' => $this->rawWaterAnalysisArticle(),
            ],
            [
                'title' => 'The five constraints that actually decide technology selection',
                'slug' => 'five-constraints-that-decide-technology-selection',
                'category' => 'Infrastructure Delivery',
                'tags' => ['DPR', 'Tendering', 'Process Design'],
                'excerpt' => 'Geography, land, power, funding and the required treated-water parameters. Every technology comparison in a DPR is really an argument about these five.',
                'featured_image' => 'services/dpr-tender-procurement-support_medium.webp',
                'published_at' => '2026-06-30 09:00:00',
                'is_featured' => true,
                'content' => $this->fiveConstraintsArticle(),
            ],
            [
                'title' => 'Sizing a sewage pumping station for the flow you will actually get',
                'slug' => 'sizing-a-sewage-pumping-station-for-real-flow',
                'category' => 'Infrastructure Delivery',
                'tags' => ['Sewerage', 'Pumping Stations', 'Hydraulic Modelling'],
                'excerpt' => 'Design flow arrives on day one of the design horizon in the model and in year twelve on site. Wet wells, pumps and rising mains all pay for that gap.',
                'featured_image' => 'services/sewerage-systems-networks-pumping-stations_medium.webp',
                'published_at' => '2026-06-16 09:45:00',
                'is_featured' => false,
                'content' => $this->pumpingStationArticle(),
            ],
            [
                'title' => 'Water reuse fails on storage and monitoring, not on process',
                'slug' => 'water-reuse-fails-on-storage-and-monitoring',
                'category' => 'Wastewater & Reuse',
                'tags' => ['Water Reuse', 'Desalination', 'Process Design'],
                'excerpt' => 'The treatment train is the easy part. Reuse schemes stall on where the water waits, who is allowed to use it, and how quality is proven before it is used.',
                'featured_image' => 'images/circular-water-reuse.jpg',
                'published_at' => '2026-05-27 08:30:00',
                'is_featured' => false,
                'content' => $this->reuseRealityArticle(),
            ],
            [
                'title' => 'What a water audit actually produces',
                'slug' => 'what-a-water-audit-actually-produces',
                'category' => 'Regulation & Compliance',
                'tags' => ['Water Audit', 'Non-Revenue Water', 'NGT Standards'],
                'excerpt' => 'Not a report. A balance that closes, a ranked list of losses with costs attached, and a sequence of actions the site can start on Monday.',
                'featured_image' => 'services/water-audit-ehs-environmental-assessment_medium.webp',
                'published_at' => '2026-05-12 09:15:00',
                'is_featured' => false,
                'content' => $this->waterAuditArticle(),
            ],
            [
                'title' => 'Turning BRSR reporting into an engineering exercise',
                'slug' => 'turning-brsr-reporting-into-an-engineering-exercise',
                'category' => 'Sustainability & ESG',
                'tags' => ['BRSR', 'ESG', 'Water Audit'],
                'excerpt' => 'Disclosure gets hard when a number cannot be traced back to a meter. Data lineage, not narrative, is what separates a defensible report from a risky one.',
                'featured_image' => 'services/sustainability-esg-climate-disclosure_medium.webp',
                'published_at' => '2026-04-28 10:30:00',
                'is_featured' => false,
                'content' => $this->brsrArticle(),
            ],
            [
                'title' => 'Biogas from sludge: when the numbers work',
                'slug' => 'biogas-from-sludge-when-the-numbers-work',
                'category' => 'Wastewater & Reuse',
                'tags' => ['Biogas', 'Sludge', 'UASB'],
                'excerpt' => 'Digestion is a stabilisation process that happens to make gas. Judge it on the disposal cost it removes first, and on the energy it returns second.',
                'featured_image' => 'services/wastewater-treatment-stp-etp-cetp_medium.webp',
                'published_at' => '2026-04-09 09:00:00',
                'is_featured' => false,
                'content' => $this->biogasArticle(),
            ],
        ];

        foreach ($articles as $article) {
            $blog = Blog::updateOrCreate(
                ['slug' => $article['slug']],
                [
                    'blog_category_id' => $categories[$article['category']] ?? null,
                    'user_id' => null,
                    'title' => $article['title'],
                    'slug' => $article['slug'],
                    'excerpt' => $article['excerpt'],
                    'content' => $article['content'],
                    'featured_image' => $article['featured_image'],
                    'is_featured' => $article['is_featured'],
                    'is_published' => true,
                    'published_at' => Carbon::parse($article['published_at']),
                    'reading_time' => null,
                ]
            );

            $blog->tags()->sync(
                collect($article['tags'])->map(fn (string $tag) => $tags[$tag] ?? null)->filter()->all()
            );

            SeoMeta::updateOrCreate(
                ['seoable_type' => Blog::class, 'seoable_id' => $blog->id],
                [
                    'meta_title' => $article['title'].' | WaterFirst',
                    'meta_description' => $article['excerpt'],
                    'meta_keywords' => implode(', ', $article['tags']),
                    'canonical_url' => null,
                    'og_title' => $article['title'],
                    'og_description' => $article['excerpt'],
                    'og_image' => null,
                    'twitter_title' => $article['title'],
                    'twitter_description' => $article['excerpt'],
                    'twitter_image' => null,
                    'schema_json' => null,
                    'robots' => 'index,follow',
                ]
            );
        }
    }

    private function unrunnablePlantArticle(): string
    {
        return $this->richLead('A sewage treatment plant that meets its discharge standard on the commissioning run and cannot hold it eighteen months later has usually not failed on process. It has failed on everything the process depends on — and the most common culprit is the residuals stream nobody scoped properly.')
            .$this->richParagraph('The pattern repeats across municipal and industrial plants. The liquid train is designed carefully, sized against a defensible influent characterisation and signed off against the applicable NGT and CPCB requirements. The sludge route is described in a paragraph. Two years on, the dewatering unit is the bottleneck, cake is being stored where it was never meant to be stored, and the operator is running the aeration basin outside its design envelope to compensate.')
            .$this->richHeading('Diagnosis', 'Symptoms and where they actually originate')
            .$this->richTable(
                ['Symptom', 'Usual root cause'],
                [
                    ['Effluent quality drifts under load', 'Solids inventory uncontrolled because wasting is limited by dewatering capacity'],
                    ['Persistent odour complaints', 'Sludge held far beyond design retention, with no stabilisation step'],
                    ['Aeration energy above budget', 'Return of poorly separated liquors adding load the design never counted'],
                    ['Chemical consumption climbing', 'Dosing used to mask a solids problem instead of correcting it'],
                    ['Frequent unplanned shutdowns', 'Screenings and grit handling designed for staffing the plant does not have'],
                ]
            )
            .$this->richCallout('The design-stage test', 'Ask one question of any treatment scheme before it is tendered: on the worst day of the year, where does the sludge go, who moves it, and what does that cost? If the answer is not in the DPR, the plant carries an operational risk that no process guarantee will cover.')
            .$this->richHeading('Correction', 'What a fix normally involves', 3)
            .$this->richChecklist([
                'Re-establish the solids balance from measurement, not from the design report',
                'Confirm dewatering capacity against realistic sludge production, including seasonal peaks',
                'Restore a stabilisation step, so the residual leaving the site is not a liability',
                'Give the sludge a destination with a named receiver, and confirm what it will accept',
                'Rebuild the operating envelope around what the crew can sustain on a night shift',
                'Only then revisit the liquid train — which is often already adequate',
            ])
            .$this->richQuote('A plant that is compliant on paper and struggling on solids is not a process failure. It is a scoping failure that arrived late.')
            .$this->richParagraph('The cost of getting this right at design stage is a few weeks of engineering. The cost of getting it wrong is carried by the operator every day for the life of the asset, and eventually by the receiving water body.')
            .$this->richClosing('WaterFirst designs the residuals train in the same cycle as the process — see <a href="/expertise/sludge-biosolids-solid-waste-management" style="color:#07579A;">Sludge, Biosolids &amp; Solid Waste Management</a>.');
    }

    private function rawWaterAnalysisArticle(): string
    {
        return $this->richLead('There is no standard treatment plant because there is no standard raw water. Before a process train can be selected, the analysis in front of you has to be interrogated — for what it measures, when it was taken, and what it quietly leaves out.')
            .$this->richHeading('First questions', 'What the sample actually represents')
            .$this->richSteps([
                [
                    'title' => 'When was it taken?',
                    'body' => 'A single grab sample describes the source on one morning. Surface water in a monsoon geography can change turbidity by an order of magnitude within days, and the plant has to hold quality through that, not around it.',
                ],
                [
                    'title' => 'How many seasons does it cover?',
                    'body' => 'A year of data across the seasonal cycle is worth more than a hundred samples from one month. Where the record is thin, the design has to be explicit about the assumption it is carrying.',
                ],
                [
                    'title' => 'What was not measured?',
                    'body' => 'The parameter absent from the report is often the one that decides the process. Groundwater analyses that omit the locally relevant contaminant are common, and expensive.',
                ],
                [
                    'title' => 'What happens upstream?',
                    'body' => 'Catchment activity — discharge points, agriculture, seasonal abstraction — predicts the variability that the sample cannot show on its own.',
                ],
            ])
            .$this->richHeading('Translation', 'From analysis to process consequence', 3)
            .$this->richTable(
                ['What the source shows', 'What it forces in the design'],
                [
                    ['High and variable turbidity', 'Robust coagulation and clarification with real margin, plus sludge handling sized for the peak, not the mean'],
                    ['Seasonal organic load', 'A treatment barrier that holds through the season, and disinfection reviewed for by-product risk'],
                    ['Dissolved contaminants', 'A process specific to the contaminant — conventional treatment will not remove what it was never designed to'],
                    ['Salinity', 'A membrane route, with pretreatment set by fouling risk and a plan for concentrate'],
                    ['Low and stable groundwater quality', 'A simpler train — and the discipline not to over-engineer around a risk that is not there'],
                ]
            )
            .$this->richCallout('Where the money goes', 'Every additional barrier is capital, footprint, power and an operator who has to keep it working. The point of reading the source carefully is not to add barriers. It is to add only the ones the source justifies, and to be able to say why.')
            .$this->richHeading('Then the other constraints', 'Quality is necessary, not sufficient', 3)
            .$this->richParagraph('Raw-water quality narrows the field. Land availability, power reliability, funding structure and the required treated-water parameters decide what survives. A process that is technically ideal and cannot be run on the power available at that site is not a candidate.')
            .$this->richClosing('More on how we approach source-driven design in <a href="/expertise/drinking-water-treatment" style="color:#07579A;">Drinking Water Treatment</a>.');
    }

    private function fiveConstraintsArticle(): string
    {
        return $this->richLead('Every technology comparison in a detailed project report is really an argument about five constraints. Name them explicitly and the comparison becomes a decision. Leave them implicit and it becomes a preference dressed up as an evaluation.')
            .$this->richCards([
                [
                    'title' => 'Geography',
                    'body' => 'Terrain, seismicity, flood level, ambient conditions and the distance between the source, the plant and the demand. It sets what is even physically sensible.',
                ],
                [
                    'title' => 'Land availability',
                    'body' => 'The single most common reason a technically sound option is dropped. Footprint is not negotiable once the site boundary is fixed.',
                ],
                [
                    'title' => 'Power availability',
                    'body' => 'Not just connected load, but reliability. A process that cannot ride through the outages that site actually experiences will not deliver its design performance.',
                ],
                [
                    'title' => 'Fund availability',
                    'body' => 'Capital ceiling, funding source and its conditions, and whether the operating budget will still exist in year seven.',
                ],
                [
                    'title' => 'Treated-water parameters',
                    'body' => 'The standard the output has to meet in service — which sets the minimum barrier count and, with it, most of the cost.',
                ],
            ])
            .$this->richHeading('In practice', 'Writing a comparison that survives review')
            .$this->richChecklist([
                'State each constraint with a value, not an adjective — footprint in square metres, not "compact"',
                'Score every option against all five, including the option you expect to recommend',
                'Show where an option fails outright, and say so plainly rather than scoring it low',
                'Carry life-cycle cost, not capital cost, into the comparison',
                'Record the assumption behind every number so a reviewer can test it',
                'Keep the rejected options in the report — the reasoning is what makes it defensible',
            ])
            .$this->richQuote('A comparison that only justifies the preferred option is not an evaluation. It is a decision that has already been made.')
            .$this->richHeading('The life-cycle test', 'Where CAPEX-led choices go wrong', 3)
            .$this->richParagraph('A process selected on capital cost alone routinely loses its advantage inside the first few years of operation — in power, in chemicals, in manpower, and in the residuals nobody priced. Where an operating budget is uncertain, the lower-energy option with the larger footprint is frequently the honest recommendation, even when it is not the elegant one.')
            .$this->richCallout('Why this matters after award', 'The five constraints do not stop applying when the tender closes. When a contractor proposes a change, the same framework tells you in an afternoon whether it is a genuine improvement or a transfer of risk onto the client.')
            .$this->richClosing('See <a href="/expertise/dpr-tender-procurement-support" style="color:#07579A;">DPR, Tender &amp; Procurement Support</a> for how we structure the documents around this.');
    }

    private function pumpingStationArticle(): string
    {
        return $this->richLead('A sewage pumping station is sized for a design flow that, in the model, arrives on day one. On site it arrives somewhere around year twelve. The gap between those two facts is where most operating problems in pumping stations are born.')
            .$this->richHeading('The early-years problem', 'Oversized on day one by design')
            .$this->richParagraph('An intermediate or terminal station built for the end-of-horizon catchment spends its first decade handling a fraction of that flow. Pumps run below their best efficiency point or cycle repeatedly. Retention in the wet well stretches, and septicity, odour and corrosion follow. None of this is a construction defect. It is the predictable consequence of a single-stage design serving a multi-stage reality.')
            .$this->richHeading('Design responses', 'What actually helps', 3)
            .$this->richChecklist([
                'Stage the pump set, so early-year duty is met by units that are correctly loaded',
                'Size the wet well against minimum flow retention as well as against peak inflow',
                'Check the duty envelope across the full staging plan, not only at ultimate flow',
                'Model surge for the rising main under every operating combination, including failure cases',
                'Provide for the standby and changeover regime the operator will actually use',
                'Design screenings and grit handling for the staffing the site will actually have',
            ])
            .$this->richTable(
                ['Check', 'Question it answers'],
                [
                    ['Minimum-flow retention', 'How long does sewage sit in the wet well in year one, and does it turn septic?'],
                    ['Duty point across stages', 'Are the pumps near best efficiency in early years, or only at ultimate flow?'],
                    ['Surge analysis', 'What does the rising main see on power failure and on restart?'],
                    ['Cycle count', 'How many starts per hour does the smallest running combination produce?'],
                    ['Access and lifting', 'Can a pump be pulled and replaced with the equipment available on site?'],
                ]
            )
            .$this->richCallout('Model before concrete', 'Network analysis in SewerGEMS or StormCAD costs a fraction of one avoidable modification to a completed station. WaterFirst verifies hydraulic performance across the staging plan before anything is committed to concrete.')
            .$this->richParagraph('The same reasoning applies to the trunk sewer feeding the station. A network sized only for ultimate flow may have insufficient self-cleansing velocity in its early years, and the desilting cost lands on the operator for a decade before the catchment catches up with the design.')
            .$this->richClosing('More on network and pumping work in <a href="/expertise/sewerage-systems-networks-pumping-stations" style="color:#07579A;">Sewerage Systems, Networks &amp; Pumping Stations</a>.');
    }

    private function reuseRealityArticle(): string
    {
        return $this->richLead('Ask why a reuse scheme stalled and the answer is almost never the treatment train. The process reached the specification. The scheme failed on where the water waits, who is permitted to use it, and how quality gets proven before anyone does.')
            .$this->richHeading('The three failure points', 'Everything downstream of the last barrier')
            .$this->richSteps([
                [
                    'title' => 'Storage',
                    'body' => 'Reclaimed water is produced continuously and used intermittently. Without storage matched to that mismatch, either the plant throttles or the water is dumped — and a scheme that dumps its product loses its justification quickly.',
                ],
                [
                    'title' => 'Distribution',
                    'body' => 'Reclaimed water needs its own network, clearly marked and physically separated from the potable system. Retrofitting that into a built environment is usually the largest single cost in the scheme.',
                ],
                [
                    'title' => 'Monitoring and release',
                    'body' => 'An operator has to be able to prove quality before water is released to use, and to divert it when a barrier underperforms. Without that, every user is trusting a process they cannot see.',
                ],
            ])
            .$this->richCallout('Design the end use first', 'The end use sets the standard, the standard sets the barrier count, and the barrier count sets the cost. Working in the other direction — treating to a general specification and then looking for a customer — is how reuse schemes end up with an excellent plant and no offtake.')
            .$this->richHeading('Multi-barrier thinking', 'Independent failure modes, not just more stages', 3)
            .$this->richChecklist([
                'Barriers chosen so that no two fail for the same reason',
                'Online monitoring at each barrier, with an automatic diversion route',
                'A defined action when a barrier underperforms, rehearsed before it is needed',
                'Storage that lets the scheme hold product back without stopping the plant',
                'A distribution network the user cannot confuse with the potable one',
                'Records that let the operator demonstrate compliance after the fact',
            ])
            .$this->richQuote('Reuse is a design objective, not a disposal strategy. If the end use is not named at the start, it will not appear at the end.')
            .$this->richHeading('Where desalination sits', 'The same discipline, a different source', 3)
            .$this->richParagraph('Seawater and brackish-water reverse osmosis raise an equivalent set of downstream questions. Pretreatment is set by the fouling risk of the intake rather than by the membrane supplier, and concentrate management deserves the same attention as permeate quality. A desalination scheme without a concentrate plan is an incomplete scheme.')
            .$this->richClosing('See <a href="/expertise/water-reuse-recycling-desalination" style="color:#07579A;">Water Reuse, Recycling &amp; Desalination</a> for the full scope.');
    }

    private function waterAuditArticle(): string
    {
        return $this->richLead('A water audit is not a report. It is a balance that closes, a ranked list of losses with rupees attached, and a sequence of actions a site can start on Monday. Anything short of that is documentation, and documentation does not save water.')
            .$this->richHeading('The deliverable', 'What a site should receive')
            .$this->richSteps([
                [
                    'title' => 'A balance that closes',
                    'body' => 'Every inflow, use, loss and discharge reconciled into one balance. Where it does not close, the gap is named and quantified rather than absorbed into an "unaccounted" line.',
                ],
                [
                    'title' => 'Losses separated from metering error',
                    'body' => 'Real physical loss and instrument error are different problems with different fixes. An audit that conflates them sends the site chasing leaks that are not there.',
                ],
                [
                    'title' => 'Recommendations ranked by payback',
                    'body' => 'Each action carries a cost, a saving and a confidence level, so the site can start with what pays first instead of what sounds best.',
                ],
                [
                    'title' => 'A neutrality position, if claimed',
                    'body' => 'Water-neutrality assessment resting on the measured balance — because a claim that cannot be traced back to a meter is a liability in any disclosure cycle.',
                ],
            ])
            .$this->richHeading('Common findings', 'What the balance usually reveals', 3)
            .$this->richTable(
                ['Finding', 'Typical response'],
                [
                    ['Unmetered internal use', 'Meter first, then decide — most sites are surprised by where the water actually goes'],
                    ['Cooling and boiler blowdown', 'Conditioning and cycle review, often the fastest payback on the list'],
                    ['Once-through use that could be recirculated', 'Recirculation with the treatment needed to sustain it, not without'],
                    ['Treated effluent discharged unused', 'Fit-for-purpose reuse against an identified internal demand'],
                    ['Distribution losses', 'Zoning and pressure management before pipe replacement'],
                ]
            )
            .$this->richCallout('The data usually already exists', 'Most sites already hold the readings an audit needs. The work is reconciling them into a balance that closes, and being honest about the parts that do not. That is an engineering exercise, not a data-collection exercise.')
            .$this->richParagraph('The same discipline extends to zero-waste-to-landfill audits and EHS reviews. A finding without an owner, a cost and a sequence is a liability on the shelf — it demonstrates that the site knew, and did not act.')
            .$this->richClosing('See <a href="/expertise/water-audit-ehs-environmental-assessment" style="color:#07579A;">Water Audit, EHS &amp; Environmental Assessment</a>.');
    }

    private function brsrArticle(): string
    {
        return $this->richLead('Sustainability disclosure becomes difficult at exactly one point: when a number in the report cannot be traced back to a meter, an invoice or a measurement. Everything else — format, narrative, framework alignment — is comparatively easy.')
            .$this->richHeading('Data lineage', 'The constraint that decides everything else')
            .$this->richParagraph('A Business Responsibility and Sustainability Report is only as defensible as the weakest number in it. Assurance providers, regulators and investors all ask the same question in different words: where did this figure come from, and what would it look like if we checked? Reports built on estimates presented as measurements do not survive that question twice.')
            .$this->richChecklist([
                'Fix the reporting boundary before any target is announced',
                'Establish a baseline from measured data, and document its source',
                'Record the method for every derived figure, including its assumptions',
                'Separate measured, calculated and estimated values in the working file',
                'Keep the trail intact between cycles, so year two is easier than year one',
                'Treat a restated number as normal practice, not as a failure',
            ])
            .$this->richHeading('The engineering base', 'Why this sits with engineers', 3)
            .$this->richParagraph('Water figures come from a site water balance. Effluent and residuals figures come from plant records. Energy figures come from metered consumption at equipment that an engineer specified. When the same team can reconcile a disclosure back to the plant it designed, the number stops being a reporting artefact and becomes a measurement.')
            .$this->richQuote('A water-neutrality claim, a reuse percentage or a decarbonisation target is only as good as the balance underneath it.')
            .$this->richHeading('Sequence', 'How a disclosure cycle should run', 3)
            .$this->richSteps([
                [
                    'title' => 'Boundary and baseline',
                    'body' => 'Agree what is in scope, and establish a baseline that can be defended before any commitment is made public.',
                ],
                [
                    'title' => 'Measurement',
                    'body' => 'Collect the operational data the disclosure depends on, and note where each figure originates.',
                ],
                [
                    'title' => 'Assessment',
                    'body' => 'Footprint, climate risk and gap analysis against the framework being reported under, including supply-chain scope.',
                ],
                [
                    'title' => 'Disclosure and action',
                    'body' => 'Report alongside the adaptation and decarbonisation actions that make the next cycle better than the current one.',
                ],
            ])
            .$this->richCallout('Where most of the footprint sits', 'For a majority of organisations the largest share of the footprint is in the supply chain, not on the site. Decarbonisation planning that stops at the factory gate reports on the smaller half of the problem.')
            .$this->richClosing('See <a href="/expertise/sustainability-esg-climate-disclosure" style="color:#07579A;">Sustainability, ESG &amp; Climate Disclosure</a>.');
    }

    private function biogasArticle(): string
    {
        return $this->richLead('Anaerobic digestion is often sold as an energy project. It is more usefully understood as a stabilisation process that happens to produce gas — and judging it that way leads to better decisions about when to build it.')
            .$this->richHeading('The primary case', 'Stabilisation before energy')
            .$this->richParagraph('Digestion reduces volatile solids, cuts the mass that has to be dewatered and moved, and turns an odorous residue into a material with a plausible reuse route. Those benefits show up as reduced disposal cost, reduced odour risk and a residual a receiver will accept. They apply whether or not the gas is ever converted to power.')
            .$this->richHeading('When the energy case stacks up', 'Four conditions', 3)
            .$this->richCards([
                [
                    'title' => 'Sufficient organic load',
                    'body' => 'Gas yield follows volatile solids destroyed. Below a certain plant scale the equipment cost is not recovered by the gas, whatever the yield curve suggests.',
                ],
                [
                    'title' => 'A stable feed',
                    'body' => 'Digesters reward consistency. A feed that swings in strength and volume produces a gas stream that downstream equipment cannot use efficiently.',
                ],
                [
                    'title' => 'A use for the gas',
                    'body' => 'On-site power that offsets plant load, or compressed biogas where a real offtake exists. Gas that is flared has value only as odour control.',
                ],
                [
                    'title' => 'Operators who can run it',
                    'body' => 'Digestion is the most process-sensitive unit on most plants. Without trained operators and instrumentation they trust, it will be bypassed.',
                ],
            ])
            .$this->richCallout('Nameplate versus yield', 'Energy recovery should be sized against realistic gas production across the year, including the low-load season, not against a nameplate figure from a supplier curve. A generator that only reaches its rating for four months is an expensive way to buy availability.')
            .$this->richHeading('High-rate anaerobic treatment', 'A different application of the same principle', 3)
            .$this->richParagraph('For strong industrial effluent — pulp and paper is the clearest example — high-rate anaerobic processes such as UASB do this work in the liquid phase. Organic load is converted before the aerobic stage rather than after it, which cuts aeration energy and sludge production at the same time. The economics there are usually stronger than on municipal sludge, because the load is more concentrated and more consistent.')
            .$this->richChecklist([
                'Assess digestion on disposal cost avoided before counting energy revenue',
                'Size gas use against measured or defensible yield, across all seasons',
                'Confirm an offtake before committing to compressed biogas upgrading',
                'Budget for the instrumentation and training the process actually needs',
                'Plan the digestate route with the same rigour as the gas route',
            ])
            .$this->richClosing('See <a href="/expertise/wastewater-treatment-stp-etp-cetp" style="color:#07579A;">Wastewater Treatment — STP, ETP &amp; CETP</a> for the wider treatment scope.');
    }
}
