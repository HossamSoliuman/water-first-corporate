<?php

namespace App\Console\Commands;

use Database\Seeders\SiteContentSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Writes database/data/site-content.json back out from the live database.
 *
 * The payload is a snapshot, not a source file: every edit the client makes in
 * /admin lands in the database only. Hand-editing the JSON and re-seeding
 * therefore reverts everything they changed since the snapshot was taken. Pull
 * the production database down, run this, and commit the result — then
 * SiteContentSeeder replays their content instead of overwriting it.
 */
class SiteContentExport extends Command
{
    protected $signature = 'site-content:export';

    protected $description = 'Snapshot the CMS content tables into database/data/site-content.json';

    public function handle(): int
    {
        $tokens = $this->tokens();

        $tables = [];

        foreach (SiteContentSeeder::tables() as $table) {
            $query = DB::table($table);

            // Pivots have no surrogate key; everything else exports in id order
            // so the committed diff only ever shows real content changes.
            if (Schema::hasColumn($table, 'id')) {
                $query->orderBy('id');
            }

            $tables[$table] = $query->get()
                ->map(fn (object $row): array => $this->tokenise((array) $row, $tokens))
                ->all();
        }

        $payload = [
            'generated_at' => now()->toIso8601String(),
            'note' => 'Snapshot of the CMS content tables, written by `php artisan site-content:export`. Brand references are {{tokens}} resolved from the settings table by SiteContentSeeder. Do not hand-edit: re-export from a database that already has the change.',
            'tables' => $tables,
        ];

        file_put_contents(
            database_path('data/site-content.json'),
            json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR)."\n"
        );

        $this->info('Exported '.array_sum(array_map('count', $tables)).' rows across '.count($tables).' tables to database/data/site-content.json.');

        return self::SUCCESS;
    }

    /**
     * The inverse of the seeder's token resolution: longest value first, so
     * "WaterFirst Engineering" does not get half-replaced by a shorter match.
     *
     * @return array<string, string>
     */
    private function tokens(): array
    {
        $settings = DB::table('settings')->pluck('value', 'key');

        $tokens = [];

        foreach (['site_name', 'contact_email', 'phone'] as $key) {
            $value = (string) ($settings[$key] ?? '');

            if ($value !== '') {
                $tokens[$value] = '{{'.$key.'}}';
            }
        }

        uksort($tokens, fn (string $a, string $b): int => mb_strlen($b) <=> mb_strlen($a));

        return $tokens;
    }

    /**
     * @param  array<string, mixed>  $row
     * @param  array<string, string>  $tokens
     * @return array<string, mixed>
     */
    private function tokenise(array $row, array $tokens): array
    {
        foreach ($row as $column => $value) {
            if (is_string($value)) {
                $row[$column] = strtr($value, $tokens);
            }
        }

        return $row;
    }
}
