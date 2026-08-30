{{-- admin/pages/partials/repeater.blade.php --}}
{{--
    A repeatable list of rows inside a page's `sections` payload.

    @param string $name    Section key, e.g. "highlights"
    @param string $label   Heading shown above the rows
    @param string $hint    Optional one-line explanation
    @param array  $fields  [['key' => 'icon', 'label' => 'Icon', 'type' => 'icon|text|textarea', 'placeholder' => '', 'span' => 1..12], ...]
    @param array  $rows    Existing rows
    @param string $addLabel
--}}
@php
    $hint = $hint ?? null;
    $addLabel = $addLabel ?? 'Add row';
    $blank = collect($fields)->mapWithKeys(fn (array $field): array => [$field['key'] => ''])->all();
    $existing = collect($rows)->map(fn ($row): array => array_replace($blank, array_intersect_key((array) $row, $blank)))->values()->all();
@endphp

<div class="mt-6" x-data="{ rows: {{ Js::from($existing) }}, blank: {{ Js::from($blank) }} }">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h4 class="text-sm font-semibold text-gray-800">{{ $label }}</h4>
            @if($hint)
                <p class="text-xs text-gray-500 mt-0.5">{{ $hint }}</p>
            @endif
        </div>
        <button type="button" @click="rows.push({ ...blank })"
                class="shrink-0 text-xs font-semibold text-teal-600 border border-teal-200 rounded-lg px-3 py-1.5 hover:bg-teal-50 transition-colors">+ {{ $addLabel }}</button>
    </div>

    <div class="mt-3 space-y-3">
        <template x-for="(row, i) in rows" :key="i">
            <div class="grid grid-cols-12 gap-3 items-start bg-gray-50 border border-gray-200 rounded-lg p-3">
                @foreach($fields as $field)
                    <div class="col-span-12 md:col-span-{{ $field['span'] ?? 12 }}">
                        <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">{{ $field['label'] }}</label>
                        @if(($field['type'] ?? 'text') === 'textarea')
                            <textarea rows="2" x-model="row.{{ $field['key'] }}"
                                      :name="`{{ $name }}[${i}][{{ $field['key'] }}]`"
                                      placeholder="{{ $field['placeholder'] ?? '' }}"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed"></textarea>
                        @else
                            <input type="text" x-model="row.{{ $field['key'] }}"
                                   :name="`{{ $name }}[${i}][{{ $field['key'] }}]`"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   @if(($field['type'] ?? 'text') === 'icon') list="wf-icons" @endif
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 @if(($field['type'] ?? 'text') === 'icon') font-mono @endif">
                        @endif
                    </div>
                @endforeach
                <div class="col-span-12 flex justify-end">
                    <button type="button" @click="rows.splice(i, 1)"
                            class="text-xs text-red-500 hover:text-red-700">Remove</button>
                </div>
            </div>
        </template>

        <p x-show="rows.length === 0" class="text-xs text-gray-400 border border-dashed border-gray-300 rounded-lg px-3 py-4 text-center">
            No rows — this section is hidden on the site.
        </p>
    </div>

    @error($name) <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
</div>
