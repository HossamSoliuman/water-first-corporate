{{-- admin/pages/edit.blade.php --}}
@extends('layouts.admin')
@section('title', ($canEditContent || $canEditHeader || $canEditIntro || $canEditBlocks ? 'Edit Page: ' : 'SEO: ').$page->title)
@section('content')
@php
    $isEditable = $canEditContent || $canEditHeader || $canEditIntro || $canEditBlocks;
    $sections = $page->sections ?? [];
@endphp

<div class="mb-6"><a href="{{ route('admin.pages.index') }}" class="text-sm text-teal-600 hover:underline">← Back to Pages</a></div>

@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm">{{ session('success') }}</div>
@endif

@include('admin.partials.icon-datalist')

<div class="max-w-3xl">
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
        <h2 class="font-heading font-bold text-gray-900">{{ $page->title }}</h2>
        <p class="text-xs text-gray-500 font-mono mt-1">/{{ $page->slug }}</p>
    </div>

    <form method="POST" action="{{ route('admin.pages.update', $page->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        @if($canEditContent || $canEditHeader)
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5 space-y-5">
            <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">{{ $canEditContent ? 'Content' : 'Page Header' }}</h3>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $page->is_published)) class="text-teal-600 rounded">
                <span class="text-sm font-medium text-gray-700">Published</span>
            </label>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $page->subtitle) }}"
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                @error('subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            @if($canEditContent)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Content</label>
                <p class="text-xs text-gray-500 mb-1.5">HTML is rendered as-is — wrap paragraphs in &lt;p&gt;…&lt;/p&gt; and use &lt;h2&gt;, &lt;ul&gt;, &lt;li&gt; for structure.</p>
                <textarea name="content" rows="24"
                          class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed font-mono">{{ old('content', $page->content) }}</textarea>
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            @endif

            @if($canEditBlocks)
                @include('admin.pages.partials.repeater', [
                    'name' => 'hero_chips',
                    'label' => 'Header Chips',
                    'hint' => 'The small icon + label row under the page subtitle.',
                    'addLabel' => 'Add chip',
                    'rows' => old('hero_chips', $sections['hero_chips'] ?? []),
                    'fields' => [
                        ['key' => 'icon', 'label' => 'Icon', 'type' => 'icon', 'span' => 4, 'placeholder' => 'clipboard-document-list'],
                        ['key' => 'label', 'label' => 'Label', 'span' => 8, 'placeholder' => 'Studies & advisory'],
                    ],
                ])
            @endif
        </div>
        @endif

        @if($canEditIntro)
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
            <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Intro Section</h3>
            <p class="text-xs text-gray-500 mt-3">Text on the left, image on the right.</p>

            <div class="grid gap-5 mt-5 md:grid-cols-3">
                <div class="md:col-span-2 space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Label</label>
                        <input type="text" name="intro_label" value="{{ old('intro_label', $sections['intro_label'] ?? '') }}"
                               class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"
                               placeholder="Small heading above the title, e.g. People First">
                        @error('intro_label') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                        <input type="text" name="intro_heading" value="{{ old('intro_heading', $sections['intro_heading'] ?? '') }}"
                               class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                        @error('intro_heading') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Body</label>
                        <p class="text-xs text-gray-500 mb-1.5">Leave a blank line between paragraphs.</p>
                        <textarea name="intro_body" rows="12"
                                  class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ old('intro_body', $sections['intro_body'] ?? '') }}</textarea>
                        @error('intro_body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Side Image</label>
                    @if($sections['side_image'] ?? '')
                        <img src="{{ asset($sections['side_image']) }}" alt="" class="w-full aspect-[4/5] object-cover rounded-lg border border-gray-200 mb-2">
                        <label class="flex items-center gap-2 cursor-pointer mb-3">
                            <input type="checkbox" name="remove_side_image" value="1" class="text-red-600 rounded">
                            <span class="text-xs text-gray-600">Remove image</span>
                        </label>
                    @else
                        <div class="w-full aspect-[4/5] rounded-lg border border-dashed border-gray-300 flex items-center justify-center text-xs text-gray-400 mb-3">No image</div>
                    @endif
                    <input type="file" name="side_image" accept="image/*"
                           class="w-full text-xs text-gray-600 border border-gray-300 rounded-lg px-3 py-2">
                    <p class="text-xs text-gray-500 mt-1.5">Portrait crop (4:5), max 4 MB.</p>
                    @error('side_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            @if($canEditBlocks)
                @include('admin.pages.partials.repeater', [
                    'name' => 'highlights',
                    'label' => 'Delivery Principles',
                    'hint' => 'The bordered list under the intro copy.',
                    'addLabel' => 'Add principle',
                    'rows' => old('highlights', $sections['highlights'] ?? []),
                    'fields' => [
                        ['key' => 'icon', 'label' => 'Icon', 'type' => 'icon', 'span' => 4, 'placeholder' => 'shield-check'],
                        ['key' => 'label', 'label' => 'Label', 'span' => 8, 'placeholder' => 'Technical accountability'],
                        ['key' => 'detail', 'label' => 'Detail', 'type' => 'textarea', 'span' => 12],
                    ],
                ])
            @endif
        </div>
        @endif

        @if($canEditBlocks)
        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
            <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Cards Section</h3>
            <p class="text-xs text-gray-500 mt-3">Heading beside the card grid. The cards themselves are managed below.</p>
            <div class="grid gap-5 mt-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="cards_heading" value="{{ old('cards_heading', $sections['cards_heading'] ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    @error('cards_heading') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Standfirst</label>
                    <textarea name="cards_body" rows="2"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ old('cards_body', $sections['cards_body'] ?? '') }}</textarea>
                    @error('cards_body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
            <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Benefits Section</h3>
            <div class="grid gap-5 mt-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="benefits_heading" value="{{ old('benefits_heading', $sections['benefits_heading'] ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    @error('benefits_heading') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Standfirst</label>
                    <textarea name="benefits_body" rows="2"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ old('benefits_body', $sections['benefits_body'] ?? '') }}</textarea>
                    @error('benefits_body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Closing line</label>
                    <input type="text" name="benefits_footnote" value="{{ old('benefits_footnote', $sections['benefits_footnote'] ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"
                           placeholder="One partner. Multiple delivery models.">
                    @error('benefits_footnote') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            @include('admin.pages.partials.repeater', [
                'name' => 'benefits',
                'label' => 'Benefits',
                'hint' => 'Shown as a bordered grid beside the heading.',
                'addLabel' => 'Add benefit',
                'rows' => old('benefits', $sections['benefits'] ?? []),
                'fields' => [
                    ['key' => 'icon', 'label' => 'Icon', 'type' => 'icon', 'span' => 4, 'placeholder' => 'globe-alt'],
                    ['key' => 'label', 'label' => 'Label', 'span' => 8, 'placeholder' => 'Global delivery capability'],
                    ['key' => 'detail', 'label' => 'Detail', 'type' => 'textarea', 'span' => 12],
                ],
            ])
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
            <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Services Section</h3>
            <div class="grid gap-5 mt-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="stages_heading" value="{{ old('stages_heading', $sections['stages_heading'] ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    @error('stages_heading') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Standfirst</label>
                    <textarea name="stages_body" rows="3"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ old('stages_body', $sections['stages_body'] ?? '') }}</textarea>
                    @error('stages_body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Button label</label>
                    <input type="text" name="stages_cta" value="{{ old('stages_cta', $sections['stages_cta'] ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500"
                           placeholder="Discuss your project">
                    <p class="text-xs text-gray-500 mt-1.5">Always links to the contact page.</p>
                    @error('stages_cta') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            @include('admin.pages.partials.repeater', [
                'name' => 'stages',
                'label' => 'Service Rows',
                'hint' => 'Numbered automatically in the order listed here.',
                'addLabel' => 'Add row',
                'rows' => old('stages', $sections['stages'] ?? []),
                'fields' => [
                    ['key' => 'icon', 'label' => 'Icon', 'type' => 'icon', 'span' => 4, 'placeholder' => 'pencil-square'],
                    ['key' => 'title', 'label' => 'Title', 'span' => 8, 'placeholder' => 'Detailed Engineering Services'],
                    ['key' => 'detail', 'label' => 'Detail', 'type' => 'textarea', 'span' => 12],
                ],
            ])
        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 mb-5">
            <h3 class="font-semibold text-gray-800 pb-3 border-b border-gray-100">Closing Band</h3>
            <p class="text-xs text-gray-500 mt-3">The blue band at the foot of the page. Leave both fields empty to hide it.</p>
            <div class="grid gap-5 mt-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                    <input type="text" name="closing_heading" value="{{ old('closing_heading', $sections['closing_heading'] ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                    @error('closing_heading') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Body</label>
                    <textarea name="closing_body" rows="3"
                              class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ old('closing_body', $sections['closing_body'] ?? '') }}</textarea>
                    @error('closing_body') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
        @endif

        @include('admin.partials.seo-fields', ['model' => $page])

        <div class="flex gap-3 mt-5">
            <button type="submit" class="bg-teal-600 text-white py-2.5 px-6 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">{{ $isEditable ? 'Save Page' : 'Save SEO' }}</button>
            <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg text-sm hover:bg-gray-50 transition-colors">Cancel</a>
        </div>
    </form>

    @if($canEditCards)
        @include('admin.pages.partials.cards', ['page' => $page, 'sections' => $sections])
    @endif
</div>

@endsection
