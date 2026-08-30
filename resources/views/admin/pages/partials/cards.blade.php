{{-- admin/pages/partials/cards.blade.php --}}
{{--
    CRUD for a page's cards. Icons and "best suited for" tags have no columns on
    page_cards, so they ride in the page's `sections.card_meta` payload keyed by
    card id — PageCardController writes them alongside each save.
--}}
@php($cardMeta = $sections['card_meta'] ?? [])

<div class="bg-white rounded-xl border border-gray-200 p-6 mt-8">
    <div class="flex items-center justify-between gap-4 pb-3 border-b border-gray-100">
        <h3 class="font-semibold text-gray-800">Cards</h3>
        <span class="text-xs text-gray-500">{{ $page->cards->count() }} card{{ $page->cards->count() === 1 ? '' : 's' }}</span>
    </div>

    <div class="mt-5 space-y-4">
        @forelse($page->cards as $card)
            @php($meta = $cardMeta[(string) $card->id] ?? [])
            <div class="border border-gray-200 rounded-lg p-4" x-data="{ open: false }">
                <div class="flex items-start gap-4">
                    @if($card->image)
                        <img src="{{ asset($card->image) }}" alt="" class="w-20 h-16 object-cover rounded-lg border border-gray-200 shrink-0">
                    @else
                        <div class="w-20 h-16 rounded-lg border border-dashed border-gray-300 flex items-center justify-center text-[10px] text-gray-400 shrink-0">No image</div>
                    @endif
                    <div class="min-w-0 flex-1">
                        <p class="font-medium text-gray-900 text-sm">{{ $card->title }}</p>
                        <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $card->description }}</p>
                        <p class="text-[11px] text-gray-400 font-mono mt-1.5">order {{ $card->order }} · icon {{ $meta['icon'] ?? '—' }}</p>
                    </div>
                    <button type="button" @click="open = ! open"
                            class="shrink-0 text-xs font-semibold text-teal-600 border border-teal-200 rounded-lg px-3 py-1.5 hover:bg-teal-50 transition-colors"
                            x-text="open ? 'Close' : 'Edit'">Edit</button>
                </div>

                <div x-show="open" x-cloak class="mt-4 pt-4 border-t border-gray-100">
                    <form method="POST" action="{{ route('admin.page-cards.update', $card->id) }}" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-12">
                        @csrf @method('PUT')
                        <div class="md:col-span-8">
                            <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Title</label>
                            <input type="text" name="title" value="{{ $card->title }}" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Order</label>
                            <input type="number" name="order" value="{{ $card->order }}" min="0" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Icon</label>
                            <input type="text" name="icon" value="{{ $meta['icon'] ?? '' }}" list="wf-icons"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm font-mono outline-none focus:ring-2 focus:ring-teal-500">
                        </div>
                        <div class="md:col-span-12">
                            <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Description</label>
                            <textarea name="description" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ $card->description }}</textarea>
                        </div>
                        <div class="md:col-span-6">
                            <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Best suited for</label>
                            <textarea name="tags" rows="5" placeholder="One item per line"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed">{{ implode("\n", $meta['tags'] ?? []) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">One item per line. Leave empty to hide the list.</p>
                        </div>
                        <div class="md:col-span-6">
                            <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Replace image</label>
                            <input type="file" name="image" accept="image/*"
                                   class="w-full text-xs text-gray-600 border border-gray-300 rounded-lg px-3 py-2">
                            <p class="text-xs text-gray-500 mt-1">Landscape crop (4:3), max 4 MB.</p>
                        </div>
                        <div class="md:col-span-12">
                            <button type="submit" class="bg-teal-600 text-white py-2 px-5 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">Save card</button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('admin.page-cards.destroy', $card->id) }}" class="mt-3"
                          onsubmit="return confirm('Delete this card?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700">Delete card</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-xs text-gray-400 border border-dashed border-gray-300 rounded-lg px-3 py-4 text-center">No cards yet.</p>
        @endforelse
    </div>

    <div class="mt-6 pt-5 border-t border-gray-100" x-data="{ open: false }">
        <button type="button" @click="open = ! open"
                class="text-xs font-semibold text-teal-600 border border-teal-200 rounded-lg px-3 py-1.5 hover:bg-teal-50 transition-colors"
                x-text="open ? 'Cancel' : '+ Add card'">+ Add card</button>

        <form x-show="open" x-cloak method="POST" action="{{ route('admin.page-cards.store', $page->id) }}" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-12 mt-4">
            @csrf
            <div class="md:col-span-9">
                <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Title</label>
                <input type="text" name="title" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div class="md:col-span-3">
                <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Icon</label>
                <input type="text" name="icon" list="wf-icons"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm font-mono outline-none focus:ring-2 focus:ring-teal-500">
            </div>
            <div class="md:col-span-12">
                <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed"></textarea>
            </div>
            <div class="md:col-span-6">
                <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Best suited for</label>
                <textarea name="tags" rows="5" placeholder="One item per line"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-teal-500 resize-y leading-relaxed"></textarea>
            </div>
            <div class="md:col-span-6">
                <label class="block text-[11px] uppercase tracking-wide font-semibold text-gray-500 mb-1">Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-xs text-gray-600 border border-gray-300 rounded-lg px-3 py-2">
            </div>
            <div class="md:col-span-12">
                <button type="submit" class="bg-teal-600 text-white py-2 px-5 rounded-lg font-semibold hover:bg-teal-700 transition-colors text-sm">Add card</button>
            </div>
        </form>
    </div>
</div>
