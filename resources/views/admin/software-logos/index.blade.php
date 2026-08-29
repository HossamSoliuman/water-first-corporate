@extends('layouts.admin')
@section('title', 'Softwares We Use')
@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-heading font-bold text-gray-900">Softwares We Use</h2>
    <span class="text-sm text-gray-500">{{ $logos->count() }} logo(s)</span>
</div>

{{-- Section content --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-sm font-semibold text-gray-700 mb-4">Home Page Section</h3>
    <form method="POST" action="{{ route('admin.software-logos.section') }}" class="space-y-4">
        @csrf @method('PUT')

        <label class="flex items-center gap-2 text-sm text-gray-700">
            <input type="hidden" name="enabled" value="0">
            <input type="checkbox" name="enabled" value="1" @checked(old('enabled', $section['enabled']))
                   class="h-4 w-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500">
            Show this section on the home page
        </label>

        <div class="grid gap-4 sm:grid-cols-3">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Eyebrow <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="eyebrow" value="{{ old('eyebrow', $section['eyebrow']) }}" placeholder="e.g. Toolset"
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                @error('eyebrow') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                <input type="text" name="heading" value="{{ old('heading', $section['heading']) }}"
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                @error('heading') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Highlighted Words <span class="text-gray-400 font-normal">(teal)</span></label>
                <input type="text" name="heading_accent" value="{{ old('heading_accent', $section['heading_accent']) }}"
                       class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                @error('heading_accent') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea name="subtitle" rows="2"
                      class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-none">{{ old('subtitle', $section['subtitle']) }}</textarea>
            @error('subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700">
            Save Section
        </button>
    </form>
</div>

{{-- Upload --}}
<div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
    <h3 class="text-sm font-semibold text-gray-700 mb-4">Upload Logos</h3>
    <form method="POST" action="{{ route('admin.software-logos.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-col sm:flex-row gap-3 items-start">
            <input type="file" name="logos[]" multiple accept="image/*"
                   class="flex-1 text-sm text-gray-600 border border-gray-300 rounded-lg px-3 py-2 w-full">
            <button type="submit"
                    class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-teal-700 shrink-0">
                Upload
            </button>
        </div>
        @error('logos') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
        @error('logos.*') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
    </form>
</div>

@if(session('success'))
<div class="mb-4 bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm">{{ session('success') }}</div>
@endif

{{-- Grid --}}
@if($logos->count())
<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @foreach($logos as $logo)
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden group">
        <div class="relative aspect-square overflow-hidden bg-gray-50 flex items-center justify-center p-4">
            <img src="{{ asset($logo->path) }}" alt="{{ $logo->name ?? 'Software logo' }}"
                 class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-200">
        </div>
        <div class="p-3 space-y-2">
            <form method="POST" action="{{ route('admin.software-logos.update', $logo->id) }}">
                @csrf @method('PUT')
                <input type="text" name="name" value="{{ $logo->name }}" placeholder="Name (optional)"
                       class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-xs outline-none focus:ring-2 focus:ring-teal-500 mb-1.5">
                <div class="flex gap-1.5">
                    <input type="number" name="order" value="{{ $logo->order }}" min="0"
                           class="w-full px-2 py-1.5 border border-gray-300 rounded-md text-xs outline-none focus:ring-2 focus:ring-teal-500">
                    <button type="submit"
                            class="px-2.5 py-1.5 bg-slate-100 hover:bg-teal-50 text-slate-600 hover:text-teal-700 rounded-md text-xs font-medium transition-colors">
                        ↑↓
                    </button>
                </div>
            </form>
            <form method="POST" action="{{ route('admin.software-logos.destroy', $logo->id) }}"
                  onsubmit="return confirm('Delete this logo?')">
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
<div class="text-center py-20 bg-white rounded-xl border border-gray-200">
    <p class="text-gray-400 text-sm">No logos yet. Upload some above.</p>
</div>
@endif

@endsection
