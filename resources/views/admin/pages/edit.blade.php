{{-- admin/pages/edit.blade.php --}}
@extends('layouts.admin')
@section('title', 'Edit Page: '.$page->title)
@section('content')
@php
    $aboutFamily = in_array($page->slug, ['our-team', 'why-choose-us', 'business-models']);
    $hasCards = in_array($page->slug, ['why-choose-us', 'business-models']);
    $headerBgSlugs = array_merge(['company-overview'], ['our-team', 'why-choose-us', 'business-models']);
@endphp
<div class="mb-6"><a href="{{ route('admin.pages.index') }}" class="text-sm text-teal-600 hover:underline">← Back to Pages</a></div>

@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-2 space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                @if($page->slug !== 'careers')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
                    <input type="text" name="subtitle" value="{{ old('subtitle', $page->subtitle) }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                @endif
                @if($page->slug !== 'careers')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Content</label>
                    <p class="text-xs text-gray-500 mb-1.5">Plain text. Each blank line starts a new paragraph.</p>
                    <textarea name="content" id="page-content" rows="20"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ old('content', $page->content) }}</textarea>
                </div>
                @endif
            </div>

            @if($page->slug === 'careers')
            @php $sec = $page->sections ?? []; @endphp

            {{-- Hero --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Hero Section</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[hero_heading]"
                           value="{{ old('sections.hero_heading', $sec['hero_heading'] ?? '') }}"
                           placeholder="People. Development. Future."
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Tagline</label>
                    <textarea name="sections[hero_tagline]" rows="2"
                              placeholder="Work with talented people, collaborate on impactful projects..."
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.hero_tagline', $sec['hero_tagline'] ?? '') }}</textarea>
                </div>
            </div>

            {{-- Intro --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Intro Section</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Label (above heading)</label>
                    <input type="text" name="sections[intro_label]"
                           value="{{ old('sections.intro_label', $sec['intro_label'] ?? '') }}"
                           placeholder="Join our team"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[intro_heading]"
                           value="{{ old('sections.intro_heading', $sec['intro_heading'] ?? '') }}"
                           placeholder="Powered by People. Driven by Growth."
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 1</label>
                    <textarea name="sections[intro_body_1]" rows="4"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.intro_body_1', $sec['intro_body_1'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 2</label>
                    <textarea name="sections[intro_body_2]" rows="3"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.intro_body_2', $sec['intro_body_2'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 3</label>
                    <textarea name="sections[intro_body_3]" rows="2"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.intro_body_3', $sec['intro_body_3'] ?? '') }}</textarea>
                </div>
            </div>

            {{-- Job openings --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Job Openings Section</h3>
                <p class="text-xs text-gray-500">Job listings are managed via <a href="{{ route('admin.job-listings.index') }}" class="text-teal-600 hover:underline">Job Listings</a> in the sidebar.</p>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[jobs_heading]"
                           value="{{ old('sections.jobs_heading', $sec['jobs_heading'] ?? '') }}"
                           placeholder="Freshers. Professionals. Specialists."
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Subheading</label>
                    <textarea name="sections[jobs_subheading]" rows="2"
                              placeholder="WaterFirst is expanding — join us in shaping the future..."
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.jobs_subheading', $sec['jobs_subheading'] ?? '') }}</textarea>
                </div>
            </div>

            {{-- Why WaterFirst --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Why WaterFirst Section</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[why_heading]"
                           value="{{ old('sections.why_heading', $sec['why_heading'] ?? '') }}"
                           placeholder="Why work with us?"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Subheading</label>
                    <textarea name="sections[why_subheading]" rows="2"
                              placeholder="Be part of an environment where your skills are nurtured..."
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('sections.why_subheading', $sec['why_subheading'] ?? '') }}</textarea>
                </div>
            </div>

            @endif

            @if($aboutFamily)
            @php $sec = $page->sections ?? []; @endphp

            {{-- Two-Column Intro --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-5">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Two-Column Section</h3>
                <p class="text-xs text-gray-500">Shown below the header: text on the left, image on the right.</p>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Label (above heading)</label>
                    <input type="text" name="sections[intro_label]"
                           value="{{ old('sections.intro_label', $sec['intro_label'] ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="sections[intro_heading]"
                           value="{{ old('sections.intro_heading', $sec['intro_heading'] ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Body</label>
                    <p class="text-xs text-gray-500 mb-1.5">Each blank line starts a new paragraph.</p>
                    <textarea name="sections[intro_body]" rows="6"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ old('sections.intro_body', $sec['intro_body'] ?? '') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Side Image (right column)</label>
                    <input type="file" name="side_image" accept="image/*" class="text-sm text-gray-600 w-full">
                    @if($sec['side_image'] ?? '')
                    <img src="{{ asset($sec['side_image']) }}" class="mt-2 w-full max-w-xs h-32 object-cover rounded-lg">
                    @endif
                </div>
            </div>

            @if($page->slug === 'our-team')
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100 mb-3">Team Members</h3>
                <p class="text-sm text-gray-500">The team grid on this page is managed under
                    <a href="{{ route('admin.team-members.index') }}" class="text-teal-600 hover:underline">Team Members</a> in the sidebar.</p>
            </div>
            @endif
            @endif

            @include('admin.partials.seo-fields', ['model' => $page])
        </div>

        <div class="space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $page->is_published)) class="text-teal-600 rounded">
                    <span class="text-sm font-medium text-gray-700">Published</span>
                </label>
                @if($page->slug !== 'careers')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ in_array($page->slug, $headerBgSlugs) ? 'Header Background Image' : 'Featured Image' }}</label>
                    <input type="file" name="featured_image" accept="image/*" class="text-sm text-gray-600 w-full">
                    @if($page->featured_image)
                    <img src="{{ asset($page->featured_image) }}" class="mt-2 w-full h-32 object-cover rounded-lg">
                    @endif
                </div>
                @endif
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-teal-600 text-white py-2.5 px-5 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">Save Page</button>
                <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50 transition-colors">Cancel</a>
            </div>
        </div>
    </div>
</form>

@if($hasCards)
{{-- ═══ CARDS MANAGER (separate from the page form) ═══ --}}
<div class="mt-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-heading font-bold text-gray-900">Cards</h2>
        <span class="text-sm text-gray-500">{{ $page->cards->count() }} card(s)</span>
    </div>

    {{-- Add Card --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
        <h3 class="text-sm font-semibold text-gray-700 mb-4">Add Card</h3>
        <form method="POST" action="{{ route('admin.page-cards.store', $page->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div class="lg:col-span-2">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                    <input type="text" name="description" value="{{ old('description') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-1.5">
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">Add Card</button>
            </div>
        </form>
    </div>

    {{-- Existing Cards --}}
    @if($page->cards->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($page->cards as $card)
        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="aspect-[4/3] bg-gray-100 overflow-hidden flex items-center justify-center">
                @if($card->image)
                <img src="{{ asset($card->image) }}" alt="{{ $card->title }}" class="w-full h-full object-cover">
                @else
                <div class="flex flex-col items-center gap-2 text-gray-300">
                    <x-icon name="squares-2x2" class="w-12 h-12"/>
                    <span class="text-xs">No image</span>
                </div>
                @endif
            </div>
            <div class="p-4">
                <form method="POST" action="{{ route('admin.page-cards.update', $card->id) }}"
                      enctype="multipart/form-data" class="space-y-2">
                    @csrf @method('PUT')
                    <input type="text" name="title" value="{{ $card->title }}" required placeholder="Title"
                           class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-xs outline-none focus:ring-2 focus:ring-teal-500">
                    <textarea name="description" rows="3" placeholder="Description"
                              class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-xs outline-none focus:ring-2 focus:ring-teal-500 resize-y">{{ $card->description }}</textarea>
                    <div class="flex gap-1.5">
                        <input type="number" name="order" value="{{ $card->order }}" min="0" placeholder="Order"
                               class="w-20 px-2 py-1.5 border border-gray-300 rounded-md text-xs outline-none focus:ring-2 focus:ring-teal-500">
                        <input type="file" name="image" accept="image/*"
                               class="flex-1 text-xs text-gray-600 border border-gray-300 rounded-md px-2 py-1.5">
                    </div>
                    <button type="submit"
                            class="w-full text-xs bg-slate-100 hover:bg-teal-50 text-slate-600 hover:text-teal-700 font-medium py-1.5 rounded-md transition-colors">
                        Save Changes
                    </button>
                </form>
                <form method="POST" action="{{ route('admin.page-cards.destroy', $card->id) }}"
                      onsubmit="return confirm('Delete this card?')" class="mt-2">
                    @csrf @method('DELETE')
                    <button type="submit"
                            class="w-full text-xs text-red-500 hover:text-red-700 font-medium py-1 hover:bg-red-50 rounded-md transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12 bg-white rounded-xl border border-gray-200">
        <p class="text-gray-400 text-sm">No cards yet. Add one above.</p>
    </div>
    @endif
</div>
@endif
@endsection
