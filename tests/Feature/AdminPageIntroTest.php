<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\User;
use Database\Seeders\PageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdminPageIntroTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(PageSeeder::class);
    }

    private function admin(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    public function test_edit_screen_exposes_intro_fields_only_where_supported(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)
            ->get(route('admin.pages.edit', Page::where('slug', 'our-team')->firstOrFail()))
            ->assertOk()
            ->assertSee('Intro Section')
            ->assertSee('name="side_image"', false);

        $this->actingAs($admin)
            ->get(route('admin.pages.edit', Page::where('slug', 'company-overview')->firstOrFail()))
            ->assertOk()
            ->assertDontSee('Intro Section');
    }

    public function test_admin_can_update_our_team_intro_copy(): void
    {
        $page = Page::where('slug', 'our-team')->firstOrFail();

        $this->actingAs($this->admin())
            ->put(route('admin.pages.update', $page), [
                'intro_label' => 'People First',
                'intro_heading' => 'A team built for engineering excellence',
                'intro_body' => "First paragraph.\n\nSecond paragraph.",
            ])
            ->assertRedirect();

        $sections = $page->fresh()->sections;

        $this->assertSame('People First', $sections['intro_label']);
        $this->assertSame('A team built for engineering excellence', $sections['intro_heading']);

        $this->get(route('our-team'))
            ->assertOk()
            ->assertSee('A team built for engineering excellence')
            ->assertSee('People First')
            ->assertSee('Second paragraph.');
    }

    public function test_admin_can_replace_the_side_image(): void
    {
        $page = Page::where('slug', 'our-team')->firstOrFail();
        $previous = $page->sections['side_image'] ?? null;

        $this->actingAs($this->admin())
            ->put(route('admin.pages.update', $page), [
                'intro_heading' => $page->sections['intro_heading'] ?? 'Our team',
                'side_image' => UploadedFile::fake()->image('team.jpg', 800, 1000),
            ])
            ->assertRedirect();

        $path = $page->fresh()->sections['side_image'];

        $this->assertNotSame($previous, $path);
        $this->assertStringStartsWith('pages/', $path);
        $this->assertFileExists(public_path($path));

        @unlink(public_path($path));
    }

    public function test_pages_without_an_intro_section_ignore_intro_input(): void
    {
        $page = Page::where('slug', 'company-overview')->firstOrFail();
        $original = $page->sections;

        $this->actingAs($this->admin())
            ->put(route('admin.pages.update', $page), [
                'intro_heading' => 'Should not be saved',
            ])
            ->assertRedirect();

        $this->assertSame($original, $page->fresh()->sections);
    }
}
