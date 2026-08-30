<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageCard;
use App\Services\ImageService;
use Illuminate\Http\Request;

class PageCardController extends Controller
{
    public function __construct(private ImageService $imageService) {}

    public function store(Request $request, Page $page)
    {
        $validated = $request->validate($this->rules());

        $data = [
            'page_id' => $page->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'order' => (int) PageCard::where('page_id', $page->id)->max('order') + 1,
        ];

        if ($request->hasFile('image')) {
            $paths = $this->imageService->upload($request->file('image'), 'public', 'page-cards');
            $data['image'] = $paths['medium'];
        }

        $card = PageCard::create($data);

        $this->saveMeta($page, $card, $validated);

        return back()->with('success', 'Card added.');
    }

    public function update(Request $request, PageCard $pageCard)
    {
        $validated = $request->validate($this->rules() + ['order' => 'required|integer|min:0']);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'order' => $validated['order'],
        ];

        if ($request->hasFile('image')) {
            if ($pageCard->image) {
                $this->imageService->delete($pageCard->image);
            }
            $paths = $this->imageService->upload($request->file('image'), 'public', 'page-cards');
            $data['image'] = $paths['medium'];
        }

        $pageCard->update($data);

        $this->saveMeta($pageCard->page, $pageCard, $validated);

        return back()->with('success', 'Card updated.');
    }

    public function destroy(PageCard $pageCard)
    {
        if ($pageCard->image) {
            $this->imageService->delete($pageCard->image);
        }

        $this->forgetMeta($pageCard->page, $pageCard);
        $pageCard->delete();

        return back()->with('success', 'Card deleted.');
    }

    /**
     * @return array<string, string>
     */
    private function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'icon' => 'nullable|string|max:60',
            'tags' => 'nullable|string|max:600',
        ];
    }

    /**
     * The cards table carries no icon or tag columns, so the presentational
     * extras ride along in the parent page's `sections` payload, keyed by card
     * id. Reordering a card keeps its icon and tags attached.
     *
     * @param  array<string, mixed>  $validated
     */
    private function saveMeta(Page $page, PageCard $card, array $validated): void
    {
        $tags = collect(preg_split('/\r\n|\r|\n/', (string) ($validated['tags'] ?? '')))
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->values()
            ->all();

        $entry = array_filter([
            'icon' => trim((string) ($validated['icon'] ?? '')) ?: null,
            'tags' => $tags ?: null,
        ]);

        $this->writeMeta($page, fn (array $meta): array => $entry === []
            ? array_diff_key($meta, [(string) $card->id => null])
            : array_replace($meta, [(string) $card->id => $entry]));
    }

    private function forgetMeta(Page $page, PageCard $card): void
    {
        $this->writeMeta($page, fn (array $meta): array => array_diff_key($meta, [(string) $card->id => null]));
    }

    /**
     * @param  callable(array<string, mixed>): array<string, mixed>  $mutate
     */
    private function writeMeta(Page $page, callable $mutate): void
    {
        $sections = $page->sections ?? [];
        $sections['card_meta'] = $mutate($sections['card_meta'] ?? []);

        $page->update(['sections' => $sections]);
    }
}
