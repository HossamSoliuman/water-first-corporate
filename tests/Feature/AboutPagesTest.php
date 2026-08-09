<?php

namespace Tests\Feature;

use Database\Seeders\PageCardSeeder;
use Database\Seeders\PageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AboutPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PageSeeder::class);
        $this->seed(PageCardSeeder::class);
    }

    /**
     * @return array<string, array{string}>
     */
    public static function aboutRoutes(): array
    {
        return [
            'company-overview' => ['company-overview'],
            'our-team' => ['our-team'],
            'why-choose-us' => ['why-choose-us'],
            'business-models' => ['business-models'],
        ];
    }

    #[DataProvider('aboutRoutes')]
    public function test_about_pages_render(string $route): void
    {
        $this->get(route($route))
            ->assertOk()
            ->assertViewIs("frontend.{$route}");
    }

    public function test_old_about_url_redirects_to_company_overview(): void
    {
        $this->get('/about')
            ->assertRedirect(route('company-overview'));
    }

    public function test_why_choose_us_shows_seeded_cards(): void
    {
        $this->get(route('why-choose-us'))
            ->assertOk()
            ->assertSee('Creatively deliver high-quality solutions');
    }

    public function test_business_models_shows_seeded_models(): void
    {
        $this->get(route('business-models'))
            ->assertOk()
            ->assertSee('Project Management Consultancy');
    }
}
