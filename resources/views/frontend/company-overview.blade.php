@extends('layouts.app')

@section('content')
    <section class="interior-hero flow-lines py-20 md:py-28">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-breadcrumbs :items="[['name' => 'Company Overview']]" />
            <div class="mt-12 grid gap-10 lg:grid-cols-12">
                <div class="lg:col-span-3"><p class="section-kicker">01 — Company</p></div>
                <div class="lg:col-span-8">
                    <h1 class="text-5xl font-semibold leading-[1.05] text-ink-800 md:text-7xl">Water is first in every system we engineer.</h1>
                    <p class="mt-7 max-w-3xl text-lg leading-8 text-ink-500">WaterFirst Engineering Consultancy Private Limited is a Bangalore-based environmental and infrastructure engineering practice focused on difficult water and wastewater problems.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-20">
        <div class="mx-auto grid max-w-7xl gap-12 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <aside class="lg:col-span-3"><div class="sticky-label"><p class="section-kicker">02 — Our position</p></div></aside>
            <div class="grid gap-12 lg:col-span-9 md:grid-cols-5">
                <div class="md:col-span-3 reveal-left">
                    <h2 class="text-3xl font-semibold leading-tight text-ink-800 md:text-4xl">Sustainable technical solutions to challenging environmental problems.</h2>
                    <div class="mt-7 grid gap-5 text-base leading-8 text-ink-500">
                        <p>We work across municipal and industrial water, wastewater, solids management, effluent treatment, sewerage, water supply, waterbody rejuvenation and operations.</p>
                        <p>Our team brings 15–35 years of experience in process, mechanical, electrical, instrumentation and automation engineering, backed by field interaction and regulatory awareness.</p>
                    </div>
                </div>
                <div class="md:col-span-2 reveal-right">
                    <div class="technical-rule bg-surface p-7">
                        <p class="font-mono text-xs uppercase tracking-[.16em] text-primary-600">Founder</p>
                        <h3 class="mt-5 text-2xl font-semibold text-ink-800">Uma Upadhyay</h3>
                        <p class="mt-3 text-sm leading-7 text-ink-500">IIT Roorkee alumna with a postgraduate qualification in Environmental Engineering and 19 years of water and wastewater treatment experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-y border-ink-200 bg-surface py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                @foreach ([
                    ['01', 'Time-bound delivery', 'Structured programmes and decisive technical coordination.'],
                    ['02', 'Cost-effective design', 'Fiscally responsible options grounded in lifecycle value.'],
                    ['03', 'Customer focus', 'Close interaction with client and project teams on site.'],
                    ['04', 'Regulatory compliance', 'Solutions aligned with NGT, MoEF&CC and CPCB requirements.'],
                ] as [$number, $title, $copy])
                    <article class="wf-card p-6 reveal">
                        <span class="section-index">{{ $number }}</span>
                        <h3 class="mt-7 text-lg font-semibold text-ink-800">{{ $title }}</h3>
                        <p class="mt-3 text-sm leading-6 text-ink-500">{{ $copy }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="deep-band py-20">
        <div class="mx-auto grid max-w-7xl items-end gap-10 px-4 sm:px-6 lg:grid-cols-12 lg:px-8">
            <div class="lg:col-span-8">
                <p class="section-kicker section-kicker-light">03 — Our promise</p>
                <h2 class="mt-7 text-4xl font-semibold leading-tight text-white md:text-5xl">Clear thinking. Responsible engineering. Lasting water outcomes.</h2>
            </div>
            <div class="lg:col-span-4 lg:text-right"><a href="{{ route('contact') }}" class="wf-btn-light">Work with WaterFirst</a></div>
        </div>
    </section>
@endsection
