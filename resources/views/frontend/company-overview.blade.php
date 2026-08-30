@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-10 md:py-14">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'Company Overview']]" />
            <div class="mt-6 grid gap-x-8 gap-y-5 lg:grid-cols-12">
                <div class="lg:col-span-12">
                    <h1 class="reveal delay-100 text-[clamp(1.75rem,3.6vw,3rem)] font-semibold leading-[1.05] text-ink-800">Water Is First in Every System We Engineer</h1>
                    <p class="reveal delay-200 mt-5 max-w-3xl text-lg leading-8 text-ink-500">WaterFirst is a multidisciplinary environmental and infrastructure engineering firm specializing in complex civil engineering infrastructure, water, wastewater, and resource management challenges. Serving clients across diverse geographies, we deliver innovative, sustainable, and technically rigorous engineering solutions that support resilient communities, industries, and ecosystems worldwide.</p>

                    <div class="reveal delay-300 mt-8 flex flex-wrap gap-x-8 gap-y-4 border-t border-ink-200 pt-6">
                        @foreach ([
                            ['map-pin', 'India & USA'],
                            ['droplet', 'Civil Engineering Specialists'],
                            ['squares-2x2', 'Multidisciplinary Excellence'],
                            ['arrow-path', 'End-to-End Project Delivery'],
                        ] as [$icon, $label])
                            <span class="group flex items-center gap-3">
                                <span class="icon-tile h-9 w-9"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                                <span class="font-mono text-[10px] uppercase tracking-[.16em] text-ink-500">{{ $label }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 md:grid-cols-5">
                <div class="md:col-span-3 reveal-left">
                    <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">Sustainable Engineering Solutions for Complex Environmental Challenges</h2>
                    <div class="technical-rule mt-7 grid gap-5 pl-6 text-base leading-8 text-ink-500">
                        <p>WaterFirst delivers integrated engineering and advisory services across the water, wastewater, environmental, and infrastructure sectors. We partner with clients globally to address complex technical, operational, and sustainability challenges through innovative, practical, and future-ready solutions.</p>
                        <p>Our multidisciplinary team combines expertise in process, mechanical, electrical, instrumentation, automation, and environmental engineering to deliver high-performance outcomes across the entire project lifecycle, from strategic planning and feasibility through detailed design, implementation support, and operational optimization.</p>
                        <p>With extensive experience in water treatment, wastewater management, resource recovery, and environmental protection, we apply advanced engineering methodologies and proven technologies to enhance infrastructure resilience, safeguard public health, protect natural ecosystems, and create long-term value for our clients and communities.</p>
                    </div>

                    <div class="mt-10 grid gap-px border border-ink-200 bg-ink-200 sm:grid-cols-3">
                        @foreach ([
                            ['shield-check', 'Public health Protection', 'Engineering safe, reliable, and sustainable systems that support community well-being and operational excellence.'],
                            ['waves', 'Water Resource Stewardship', ' Delivering solutions that preserve water quality, promote responsible resource management, and ensure regulatory compliance.'],
                            ['globe-alt', 'Environmental Sustainability', 'Balancing infrastructure performance with ecological responsibility to achieve resilient and sustainable environmental outcomes.'],
                        ] as $index => [$icon, $label, $detail])
                            <div class="group bg-white p-5 reveal {{ ['', 'delay-100', 'delay-200'][$index] }}">
                                <span class="icon-tile h-10 w-10"><x-icon name="{{ $icon }}" class="h-4 w-4" /></span>
                                <p class="mt-4 font-mono text-[10px] uppercase tracking-[.16em] text-primary-600">{{ $label }}</p>
                                <p class="mt-1.5 text-sm leading-6 text-ink-500">{{ $detail }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="md:col-span-2 reveal-right">
                    <div class="technical-rule bg-surface p-7">
                        <div class="flex items-center justify-between">
                            <p class="font-mono text-xs uppercase tracking-[.16em] text-primary-600">Founder</p>
                            <span class="icon-tile h-10 w-10"><x-icon name="user-circle" class="h-5 w-5" /></span>
                        </div>
                        <h3 class="mt-5 text-2xl font-semibold text-ink-800">Uma Upadhyay</h3>
                        <p class="mt-3 text-sm leading-7 text-ink-500">Uma Upadhyay is the Founder and Managing Director of WaterFirst, with over 20 years of international experience in water, wastewater, environmental, and infrastructure engineering. She has successfully led multidisciplinary projects across North America, the United Kingdom, Australia & New Zealand (ANZ), Europe, the Middle East, and Asia, delivering technically advanced and sustainable solutions for municipal, industrial, and utility-sector clients.<br><br>
                        Having worked across diverse regulatory environments, climatic conditions, and stakeholder landscapes, she combines global best practices with practical engineering insight to address complex water and environmental challenges. Under her leadership, WaterFirst has established itself as a trusted engineering partner known for technical excellence, innovation, and client-focused delivery.</p>

                        <div class="mt-6 grid gap-3 border-t border-ink-200 pt-5">
                            @foreach ([
                                ['academic-cap', 'IIT Roorkee alumna'],
                                ['document-text', 'PG — Environmental Engineering'],
                                ['clock', '20+ Years of Global Engineering Experience'],
                            ] as [$icon, $credential])
                                <span class="group flex items-center gap-3">
                                    <span class="icon-tile h-8 w-8"><x-icon name="{{ $icon }}" class="h-3.5 w-3.5" /></span>
                                    <span class="text-sm leading-6 text-ink-500">{{ $credential }}</span>
                                </span>
                            @endforeach
                        </div>
                    </div>

                
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-ink-200 bg-surface py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-6 border-b border-ink-200 pb-8 md:flex-row md:items-end md:justify-between">
                <div>
                    <h2 class="max-w-2xl text-4xl font-semibold leading-tight text-ink-800">Everything water touches, engineered end to end.</h2>
                </div>
                <a href="{{ route('expertise.index') }}" class="wf-btn-outline group">
                    Full expertise map <x-icon name="arrow-long-right" class="h-4 w-4 arrow-nudge" />
                </a>
            </div>

            <div class="mt-10 grid gap-px border border-ink-200 bg-ink-200 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['building-library', 'Water Treatment & Supply', 'Source development, treatment, desalination, storage, transmission, and distribution systems for municipal and industrial applications.'],
                    ['waves', 'Wastewater Treatment & Reuse', 'Advanced wastewater treatment, water recycling, nutrient removal, resource recovery, and sustainable reuse solutions.'],
                    ['truck', 'Industrial Water & Effluent Management', 'Process water systems, industrial effluent treatment, compliance optimization, and Zero Liquid Discharge (ZLD) solutions.'],
                    ['beaker', 'Biosolids & Resource Recovery', 'Sludge treatment, stabilization, dewatering, energy recovery, beneficial reuse, and circular economy strategies.'],
                    ['funnel', 'Sewerage & Conveyance Infrastructure', 'Collection networks, pumping stations, force mains, hydraulic modelling, and wastewater conveyance systems.'],
                    ['droplet', 'Integrated Water Resources Management', 'Surface water, groundwater, stormwater, water security, resilience planning, and sustainable resource management.'],
                    ['globe-alt', 'Environmental Restoration & Waterbody Rejuvenation', 'Lake, river, wetland, and receiving-water restoration programs focused on ecological resilience and environmental stewardship.'],
                    ['wrench-screwdriver', 'Operations, Asset Performance & Digital Solutions', 'Commissioning, operational support, asset management, process optimization, automation, digital monitoring, and performance improvement.'],
                ] as $index => [$icon, $label, $detail])
                    <div class="group flex flex-col bg-white p-7 transition-colors hover:bg-surface reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index % 4] }}">
                        <div class="flex items-start justify-between gap-4">
                            <span class="icon-tile h-12 w-12"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <h3 class="mt-6 font-heading text-base font-medium leading-snug text-ink-800 group-hover:text-primary-600">
                            <span class="underline-grow">{{ $label }}</span>
                        </h3>
                        <p class="mt-2.5 text-sm leading-6 text-ink-500">{{ $detail }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="border-b border-ink-200 bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-12 lg:grid-cols-12">
                <div class="reveal-left lg:col-span-4">
                    <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">Integrated Engineering Disciplines. One Global Delivery Platform.</h2>
                    <p class="mt-6 max-w-lg text-base leading-7 text-ink-500">15–35 years of experience per discipline, backed by field interaction and regulatory awareness.Bringing together world-class technical expertise across core engineering disciplines to deliver complex water, wastewater, environmental, and infrastructure projects worldwide.<br><br>
                    
                    

</p>

                    <svg class="mt-10 hidden w-full max-w-sm text-accent-500 lg:block" viewBox="0 0 320 80" fill="none" aria-hidden="true">
                        <path class="draw-stroke" d="M4 54c44-46 86 26 130-6s70 30 182-14" stroke="currentColor" stroke-width="1.5" stroke-opacity=".55"/>
                        <path class="flow-stroke" d="M4 54c44-46 86 26 130-6s70 30 182-14" stroke="currentColor" stroke-width="2"/>
                        <circle class="pulse-node" cx="134" cy="48" r="4" fill="currentColor"/>
                    </svg>
                </div>

                <div class="lg:col-span-8">
                    @foreach ([
                        ['01', 'beaker', 'Process engineering', 'Process selection, treatment technology evaluation, mass balance development, process modelling, hydraulic design, and optimization of water and wastewater treatment systems.'],
                        ['02', 'cog-6-tooth', 'Mechanical engineering', 'Equipment specification, hydraulic systems, pumping stations, pipeline networks, treatment plant layouts, and mechanical infrastructure design.'],
                        ['03', 'bolt', 'Electrical engineering', 'Power distribution systems, motor control centers, standby power solutions, drives, energy management, and plant electrical infrastructure.'],
                        ['04', 'signal', 'Instrumentation', 'Process instrumentation, online monitoring systems, control philosophies, analytics, performance monitoring, and regulatory compliance reporting.'],
                        ['05', 'cpu-chip', 'Automation', 'PLC/SCADA systems, digital integration, intelligent process control, remote monitoring, asset performance management, and operational optimization.'],
                    ] as $index => [$number, $icon, $discipline, $detail])
                        <div class="hover-row group grid grid-cols-[2rem_2.75rem_1fr_auto] items-center gap-4 border-t border-ink-200 py-5 last:border-b reveal {{ ['', 'delay-100', 'delay-200', 'delay-300', 'delay-400'][$index] }}">
                            <span class="font-mono text-xs text-accent-600">{{ $number }}</span>
                            <span class="icon-tile h-11 w-11"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <span>
                                <span class="block font-heading text-base font-medium text-ink-800 md:text-lg">{{ $discipline }}</span>
                                <span class="mt-1 block text-sm leading-6 text-ink-500">{{ $detail }}</span>
                            </span>
                            <span class="h-2 w-2 border border-accent-600 transition-colors group-hover:bg-accent-500"></span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="bg-surface py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3">
                    <div class="sticky-label">
                        <h2 class="text-3xl font-semibold leading-tight text-ink-800">Water Treatment Expertise Across Diverse Source Waters</h2>
                        <p class="mt-6 text-sm leading-7 text-ink-500">Applying proven and advanced treatment technologies to address varying source water characteristics, regulatory requirements, and operational objectives worldwide.</p>
                    </div>
                </div>

                <div class="grid gap-5 sm:grid-cols-3 lg:col-span-9">
                    @foreach ([
                        ['waves', 'Seawater & Desalination', 'Advanced desalination and high-salinity treatment solutions for municipal, industrial, and water security applications in coastal and water-stressed regions.'],
                        ['droplet', 'Surface Water Systems', 'Treatment of river, reservoir, and lake water sources with process solutions designed to manage seasonal variability, turbidity, and changing water quality conditions.'],
                        ['funnel', 'Groundwater Treatment', 'Specialized treatment for borehole and aquifer sources, including the removal of naturally occurring and anthropogenic contaminants to meet potable and industrial water standards.'],
                    ] as $index => [$icon, $source, $detail])
                        <article class="wf-card group flex flex-col p-7 reveal {{ ['', 'delay-100', 'delay-200'][$index] }}">
                            <div class="flex items-start justify-between gap-4">
                                <span class="icon-tile h-12 w-12"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                                <span class="section-index">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <h3 class="mt-7 font-heading text-lg font-semibold text-ink-800 group-hover:text-primary-600">
                                <span class="underline-grow">{{ $source }}</span>
                            </h3>
                            <p class="mt-3 flex-1 text-sm leading-6 text-ink-500">{{ $detail }}</p>
                            <span class="mt-6 flex items-center gap-3 border-t border-ink-100 pt-4" aria-hidden="true">
                                <span class="h-px flex-1 bg-ink-200 transition-colors duration-300 group-hover:bg-accent-400"></span>
                                <span class="h-2 w-2 border border-accent-600 transition-colors duration-300 group-hover:bg-accent-500"></span>
                            </span>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-ink-200 bg-white py-16 md:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="border-b border-ink-200 pb-8">
                <h2 class="max-w-2xl text-4xl font-semibold leading-tight text-ink-800">Our Commitment to Delivery Excellence</h2>
            </div>

            <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['01', 'clock', 'Schedule Certainty', 'Disciplined project management, proactive risk mitigation, and efficient execution to achieve predictable and timely project delivery.'],
                    ['02', 'scale', 'Value-Driven Engineering', 'Optimized technical solutions balancing performance, reliability, sustainability, and whole-of-life cost efficiency.'],
                    ['03', 'users', 'Client-Centric Collaboration', 'Close partnership with clients, stakeholders, and project teams to ensure alignment, transparency, and successful project outcomes.'],
                    ['04', 'shield-check', 'Regulatory & Technical Compliance', 'Solutions designed in accordance with international standards, local regulations, environmental requirements, and industry best practices.'],
                ] as $index => [$number, $icon, $title, $copy])
                    <article class="wf-card group flex flex-col p-7 reveal {{ ['', 'delay-100', 'delay-200', 'delay-300'][$index] }}">
                        <div class="flex items-start justify-between gap-4">
                            <span class="icon-tile h-12 w-12"><x-icon name="{{ $icon }}" class="h-5 w-5" /></span>
                            <span class="section-index">{{ $number }}</span>
                        </div>
                        <h3 class="mt-7 font-heading text-lg font-semibold text-ink-800 group-hover:text-primary-600">
                            <span class="underline-grow">{{ $title }}</span>
                        </h3>
                        <p class="mt-3 flex-1 text-sm leading-6 text-ink-500">{{ $copy }}</p>
                        <span class="mt-6 flex items-center gap-3 border-t border-ink-100 pt-4" aria-hidden="true">
                            <span class="h-px flex-1 bg-ink-200 transition-colors duration-300 group-hover:bg-accent-400"></span>
                            <span class="h-2 w-2 border border-accent-600 transition-colors duration-300 group-hover:bg-accent-500"></span>
                        </span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

@endsection
