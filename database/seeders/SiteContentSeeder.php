<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Replays the CMS content shipped in database/data/site-content.json.
 *
 * The payload carries the general marketing content and the engineering service
 * taxonomy. Brand-specific tables are deliberately absent from it:
 *
 *  - `settings`     — site name, logo, contact details are this site's own.
 *  - `team_members` — named individuals do not transfer between companies.
 *
 * Brand references inside the content are stored as `{{tokens}}` and resolved
 * from `settings` at seed time, so re-running after the client supplies real
 * contact details refreshes the prose (including the legal pages) in place.
 *
 * Rows are written through the query builder rather than Eloquent on purpose:
 * primary keys, slugs and timestamps must survive verbatim, and `HasSlug` would
 * otherwise regenerate slugs and break the ~30 views that reference these URLs.
 */
class SiteContentSeeder extends Seeder
{
    /**
     * Tables in foreign-key-safe insert order. Clearing walks this in reverse.
     *
     * @var list<string>
     */
    private const TABLES = [
        'pages',
        'page_cards',
        'services',
        'industries',
        'case_study_categories',
        'case_studies',
        'blog_categories',
        'blog_tags',
        'blogs',
        'blog_tag',
        'hero_slides',
        'software_logos',
        'job_listings',
        'career_images',
        'seo_metas',
    ];

    /** Pivot tables have no surrogate key, so they are replaced wholesale. */
    private const PIVOTS = ['blog_tag'];

    public function run(): void
    {
        $payload = $this->payload();
        $tokens = $this->tokens();

        DB::transaction(function () use ($payload, $tokens) {
            // Clear first, in reverse dependency order. The payload owns these
            // tables outright, and the incoming id/slug pairs overlap the
            // outgoing ones, so an in-place update would trip unique indexes.
            foreach (array_reverse(self::TABLES) as $table) {
                DB::table($table)->delete();
            }

            foreach (self::TABLES as $table) {
                $rows = $payload[$table] ?? [];

                if (in_array($table, self::PIVOTS, true)) {
                    DB::table($table)->insert($rows);

                    continue;
                }

                if ($table === 'blogs') {
                    $rows = array_map($this->reattachAuthor(...), $rows);
                }

                foreach (array_chunk($rows, 50) as $chunk) {
                    DB::table($table)->insert(
                        array_map(fn (array $row): array => $this->resolveTokens($row, $tokens), $chunk)
                    );
                }
            }
        });

        $this->command?->info('Seeded '.array_sum(array_map('count', $payload)).' content rows across '.count(self::TABLES).' tables.');
    }

    /**
     * @return array<string, list<array<string, mixed>>>
     */
    private function payload(): array
    {
        $path = database_path('data/site-content.json');

        if (! is_file($path)) {
            throw new \RuntimeException("Content payload missing: {$path}");
        }

        $decoded = json_decode((string) file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

        return $decoded['tables'];
    }

    /**
     * Brand tokens resolved from the live settings table.
     *
     * @return array<string, string>
     */
    private function tokens(): array
    {
        $settings = DB::table('settings')->pluck('value', 'key');

        return [
            '{{site_name}}' => (string) ($settings['site_name'] ?? config('app.name')),
            '{{contact_email}}' => (string) ($settings['contact_email'] ?? ''),
            '{{phone}}' => (string) ($settings['phone'] ?? ''),
        ];
    }

    /**
     * The payload's author id comes from the source install. Point it at a user
     * that exists here, or detach it — a fresh database (CI, a new deploy) has
     * no matching row and `blogs.user_id` is a nullable foreign key.
     *
     * @param  array<string, mixed>  $row
     * @return array<string, mixed>
     */
    private function reattachAuthor(array $row): array
    {
        $row['user_id'] = DB::table('users')->where('id', $row['user_id'])->exists()
            ? $row['user_id']
            : DB::table('users')->min('id');

        return $row;
    }

    /**
     * @param  array<string, mixed>  $row
     * @param  array<string, string>  $tokens
     * @return array<string, mixed>
     */
    private function resolveTokens(array $row, array $tokens): array
    {
        foreach ($row as $column => $value) {
            if (is_string($value) && str_contains($value, '{{')) {
                $row[$column] = strtr($value, $tokens);
            }
        }

        return $row;
    }
}
