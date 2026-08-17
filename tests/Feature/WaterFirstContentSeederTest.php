<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\CaseStudy;
use App\Models\Industry;
use App\Models\JobListing;
use App\Models\Page;
use App\Models\Service;
use App\Models\Setting;
use App\Models\TeamMember;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

/**
 * The marketing content and service taxonomy now ship in
 * database/data/site-content.json and are replayed by SiteContentSeeder.
 *
 * These tests pin the two halves of that arrangement: the payload owns the
 * content, and the site's own identity (name, contact details, people) survives
 * the import untouched.
 */
class WaterFirstContentSeederTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_the_content_payload_is_fully_seeded(): void
    {
        $this->assertSame(10, Service::query()->where('is_active', true)->count());
        $this->assertSame(8, Industry::query()->count());
        $this->assertSame(15, CaseStudy::query()->count());
        $this->assertSame(5, Blog::query()->count());
        $this->assertSame(24, JobListing::query()->count());
        $this->assertSame(8, Page::query()->count());

        $this->assertSame([
            'Surveying, GIS & Geospatial Engineering Services',
            'Urban & Infrastructure Development Engineering',
            'Transportation Infrastructure Engineering',
            'Environmental Engineering & Hydrogeology',
            'Water, Wastewater & Drainage Engineering',
            'Structural Engineering',
            'Architectural Design Services',
            'Industrial, LNG, Oil & Gas & Energy Engineering',
            'BIM & Digital Engineering',
            'MEPF Engineering Services',
        ], Service::query()->where('is_active', true)->orderBy('order')->pluck('name')->all());
    }

    public function test_the_pages_the_controllers_resolve_by_slug_all_exist(): void
    {
        foreach (['home', 'company-overview', 'our-team', 'why-choose-us', 'business-models', 'careers', 'privacy-policy', 'terms-conditions'] as $slug) {
            $this->assertTrue(
                Page::query()->where('slug', $slug)->exists(),
                "Page '{$slug}' is resolved by a frontend controller and must exist."
            );
        }
    }

    public function test_home_page_links_to_every_active_expertise_area(): void
    {
        $services = Service::query()->where('is_active', true)->orderBy('order')->get();

        $response = $this->get(route('home'));

        $response->assertOk();

        foreach ($services as $service) {
            $response->assertSee(route('expertise.show', $service->slug), false);
        }
    }

    public function test_the_import_carries_no_trace_of_the_source_brand(): void
    {
        foreach ($this->contentColumns() as [$table, $column]) {
            $hits = DB::table($table)->whereRaw("LOWER({$column}) LIKE ?", ['%alada%'])->count();

            $this->assertSame(0, $hits, "Source brand leaked into {$table}.{$column}.");
        }
    }

    public function test_every_brand_token_resolves_from_settings(): void
    {
        foreach ($this->contentColumns() as [$table, $column]) {
            $hits = DB::table($table)->where($column, 'like', '%{{%')->count();

            $this->assertSame(0, $hits, "Unresolved template token left in {$table}.{$column}.");
        }

        $this->assertStringContainsString('WaterFirst', (string) Page::query()->where('slug', 'careers')->value('title'));
        $this->assertStringContainsString(
            (string) Setting::query()->where('key', 'contact_email')->value('value'),
            (string) Page::query()->where('slug', 'privacy-policy')->value('content')
        );
    }

    public function test_the_site_identity_is_not_overwritten_by_the_import(): void
    {
        $this->assertSame('WaterFirst', Setting::query()->where('key', 'site_name')->value('value'));
        $this->assertSame('Bangalore, Karnataka, India', Setting::query()->where('key', 'address_india')->value('value'));
        $this->assertSame('images/waterfirst-logo.svg', Setting::query()->where('key', 'logo_url')->value('value'));

        // People do not transfer between companies, so the payload omits them.
        $this->assertSame(0, TeamMember::query()->whereIn('name', [
            'Shivam Gade', 'Akshay Chavare', 'Chetan Waghcahuare', 'Dhananjay Durgude',
        ])->count());
    }

    public function test_every_referenced_media_file_exists(): void
    {
        $missing = [];

        foreach ($this->contentColumns() as [$table, $column]) {
            foreach (DB::table($table)->pluck($column) as $value) {
                if (! is_string($value) || $value === '') {
                    continue;
                }

                preg_match_all(
                    '~(?<![\w/])((?:blogs|career-gallery|page-cards|pages|services|software-logos|uploads|images|videos)/[A-Za-z0-9_\-./]+\.(?:webp|png|jpe?g|svg|gif|mp4|webm|avif))~i',
                    str_replace('\\/', '/', $value),
                    $matches
                );

                foreach ($matches[1] as $path) {
                    if (! is_file(public_path($path))) {
                        $missing[$path] = "{$table}.{$column}";
                    }
                }
            }
        }

        $this->assertSame([], $missing, 'Content references media that is not on disk.');
    }

    public function test_the_content_seeder_is_idempotent(): void
    {
        $this->seed(DatabaseSeeder::class);
        $this->seed(DatabaseSeeder::class);

        $this->assertSame(10, Service::query()->where('is_active', true)->count());
        $this->assertSame(15, CaseStudy::query()->count());
        $this->assertSame(27, DB::table('blog_tag')->count());
        $this->assertSame(38, DB::table('seo_metas')->count());
    }

    /**
     * Every free-text column the imported payload writes into.
     *
     * @return list<array{0: string, 1: string}>
     */
    private function contentColumns(): array
    {
        $map = [
            'pages' => ['title', 'subtitle', 'content', 'sections', 'featured_image'],
            'page_cards' => ['title', 'description', 'image'],
            'services' => ['name', 'short_description', 'description', 'featured_image'],
            'industries' => ['name', 'description', 'featured_image'],
            'case_studies' => ['title', 'client_name', 'challenge', 'solution', 'result', 'cta_title', 'cta_text', 'cta_link', 'featured_image', 'gallery'],
            'blogs' => ['title', 'excerpt', 'content', 'featured_image'],
            'blog_categories' => ['name', 'description'],
            'job_listings' => ['position_name', 'location'],
            'career_images' => ['path', 'alt'],
            'software_logos' => ['name', 'path'],
            'hero_slides' => ['title', 'file_path'],
            'seo_metas' => ['meta_title', 'meta_description', 'og_title', 'og_description', 'og_image', 'schema_json'],
        ];

        $columns = [];

        foreach ($map as $table => $tableColumns) {
            foreach ($tableColumns as $column) {
                $columns[] = [$table, $column];
            }
        }

        return $columns;
    }
}
