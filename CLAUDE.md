# Project: WaterFirst

Marketing site + CMS for **WaterFirst Engineering Consultancy Private Limited** (Bangalore, Karnataka, India) — a water, wastewater and multi-disciplinary engineering consultancy founded by Uma Upadhyay.

> **Rebranded from Alada.** This codebase was originally built for a brand called **Alada**. The rebrand is complete: no "Alada" string, palette token or legacy asset remains, and the legacy upload folders (`public/services`, `public/software-logos`, `public/team-members`, `public/uploads`) were deleted — admin upload controllers recreate them on demand. Public pages changed; the admin panel did not. `docs/REBRAND-WATERFIRST-GUIDE.md` is the historical brief; note §6 is superseded.

## Architecture notes (non-obvious)

- **The frontend does not use the Vite/Tailwind build.** `resources/views/layouts/app.blade.php` loads `https://cdn.tailwindcss.com`, configures Tailwind **inline**, and carries ~450 lines of inline `<style>`. That file is the single source of truth for public-site design tokens, custom classes and animations. Editing `tailwind.config.js` or `resources/css/app.css` alone changes nothing on the public site.
- `resources/views/layouts/admin.blade.php` loads the Tailwind CDN with its **own independent** inline config. Frontend and admin theming cannot break each other.
- Public pages are CMS-driven. Content lives in DB tables (`services`, `industries`, `pages` + `page_cards`, `case_studies`, `blogs`, `team_members`, `hero_slides`, `software_logos`, `job_listings`, `settings`) and is editable from `/admin`. Change content via seeders (re-runnable) — not by hardcoding it into Blade.
- **The marketing content and service taxonomy ship as data, not as PHP.** `database/data/site-content.json` holds every content row; `SiteContentSeeder` clears the content tables and replays it, preserving primary keys, slugs and timestamps verbatim (it writes through the query builder precisely so `HasSlug` cannot regenerate slugs). `database/database.sqlite` is gitignored, so **production picks up content changes only when that seeder is run over SSH** — a `git pull` alone does nothing.
- Two tables are deliberately absent from that payload and stay owned by their own seeders: `settings` (`SettingSeeder` — site name, logo, contact details) and `team_members` (`TeamMemberSeeder`). Brand references inside the content are stored as `{{site_name}}` / `{{contact_email}}` / `{{phone}}` tokens that `SiteContentSeeder` resolves from `settings` at seed time, so the prose — including the legal pages — follows the site's own identity.
- "Services" is the internal model name; the public-facing term and URL is **Expertise** (`/expertise`, `expertise.index`, `expertise.show`). The taxonomy is whatever `site-content.json` contains (currently 10 broad engineering disciplines). The older per-model content seeders (`ServiceSeeder`, `PageSeeder`, `CaseStudySeeder`, `BlogSeeder`, …) still hold the original 12 water-only expertise areas from `docs/WaterFirst_Presentation_20260717content.pdf` and are **intentionally unwired from `DatabaseSeeder`** — running one alongside `SiteContentSeeder` deletes the imported rows.
- `Service`, `CaseStudy`, `Blog` etc. use Spatie `HasSlug`, which slugs on create only. Renaming a record does **not** regenerate its slug — set slugs explicitly when a URL must change.
- Icons come from a fixed vocabulary in `resources/views/components/icon.blade.php`. Check it before using an icon name in a seeder.
- Frontend scroll animations use the `.reveal`, `.reveal-left`, `.reveal-right`, `.reveal-scale` + `.delay-*` classes defined in `layouts/app.blade.php`.

## Brand palette (current)

`primary #07579A` · `secondary #1976B8` · `accent #00A6A6` · `surface #F5FBFE` · `ink #12324A` · `white #FFFFFF`

The accent teal is a highlight (rules, icons, chips, focus rings) — never a large field colour. The legacy Alada palette (`navy`/`teal`/`brown` scales, copper `#8e6b51`) and its glossy/glass system (`.card-glass`, `.btn-glossy*`, `.glass-chip`, `.texture`) are being removed — do not extend them.

## Working agreements

- **No new migrations for content or branding work.** The schema already models what the site needs.
- Don't rename existing route names or public URL slugs — they're referenced across ~30 views.
- Purge `storage/framework/views/*` after Blade edits if stale compiled views cause confusion.
- Placeholder contact details, logo and team data are pending client input — flag them, don't invent them.

<laravel-boost-guidelines>
=== foundation rules ===

# Laravel Boost Guidelines

The Laravel Boost guidelines are specifically curated by Laravel maintainers for this application. These guidelines should be followed closely to ensure the best experience when building Laravel applications.

## Foundational Context

This application is a Laravel application and its main Laravel ecosystems package & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.5
- laravel/framework (LARAVEL) - v12
- laravel/prompts (PROMPTS) - v0
- laravel/boost (BOOST) - v2
- laravel/mcp (MCP) - v0
- laravel/pail (PAIL) - v1
- laravel/pint (PINT) - v1
- laravel/sail (SAIL) - v1
- pestphp/pest (PEST) - v3
- phpunit/phpunit (PHPUNIT) - v11
- tailwindcss (TAILWINDCSS) - v4

## Skills Activation

This project has domain-specific skills available in `**/skills/**`. You MUST activate the relevant skill whenever you work in that domain—don't wait until you're stuck.

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, and naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove they work. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure; don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

=== boost rules ===

# Laravel Boost

## Tools

- Laravel Boost is an MCP server with tools designed specifically for this application. Prefer Boost tools over manual alternatives like shell commands or file reads.
- Use `database-query` to run read-only queries against the database instead of writing raw SQL in tinker.
- Use `database-schema` to inspect table structure before writing migrations or models.
- Use `get-absolute-url` to resolve the correct scheme, domain, and port for project URLs. Always use this before sharing a URL with the user.
- Use `browser-logs` to read browser logs, errors, and exceptions. Only recent logs are useful, ignore old entries.

## Searching Documentation (IMPORTANT)

- Always use `search-docs` before making code changes. Do not skip this step. It returns version-specific docs based on installed packages automatically.
- Pass a `packages` array to scope results when you know which packages are relevant.
- Use multiple broad, topic-based queries: `['rate limiting', 'routing rate limiting', 'routing']`. Expect the most relevant results first.
- Do not add package names to queries because package info is already shared. Use `test resource table`, not `filament 4 test resource table`.

### Search Syntax

1. Use words for auto-stemmed AND logic: `rate limit` matches both "rate" AND "limit".
2. Use `"quoted phrases"` for exact position matching: `"infinite scroll"` requires adjacent words in order.
3. Combine words and phrases for mixed queries: `middleware "rate limit"`.
4. Use multiple queries for OR logic: `queries=["authentication", "middleware"]`.

## Artisan

- Run Artisan commands directly via the command line (e.g., `php artisan route:list`). Use `php artisan list` to discover available commands and `php artisan [command] --help` to check parameters.
- Inspect routes with `php artisan route:list`. Filter with: `--method=GET`, `--name=users`, `--path=api`, `--except-vendor`, `--only-vendor`.
- Read configuration values using dot notation: `php artisan config:show app.name`, `php artisan config:show database.default`. Or read config files directly from the `config/` directory.

## Tinker

- Execute PHP in app context for debugging and testing code. Do not create models without user approval, prefer tests with factories instead. Prefer existing Artisan commands over custom tinker code.
- Always use single quotes to prevent shell expansion: `php artisan tinker --execute 'Your::code();'`
  - Double quotes for PHP strings inside: `php artisan tinker --execute 'User::where("active", true)->count();'`

=== php rules ===

# PHP

- Always use curly braces for control structures, even for single-line bodies.
- Use PHP 8 constructor property promotion: `public function __construct(public GitHub $github) { }`. Do not leave empty zero-parameter `__construct()` methods unless the constructor is private.
- Use explicit return type declarations and type hints for all method parameters: `function isAccessible(User $user, ?string $path = null): bool`
- Use TitleCase for Enum keys: `FavoritePerson`, `BestLake`, `Monthly`.
- Prefer PHPDoc blocks over inline comments. Only add inline comments for exceptionally complex logic.
- Use array shape type definitions in PHPDoc blocks.

=== deployments rules ===

# Deployment

- Laravel can be deployed using [Laravel Cloud](https://cloud.laravel.com/), which is the fastest way to deploy and scale production Laravel applications.

=== herd rules ===

# Laravel Herd

- The application is served by Laravel Herd at `https?://[kebab-case-project-dir].test`. Use the `get-absolute-url` tool to generate valid URLs. Never run commands to serve the site. It is always available.
- Use the `herd` CLI to manage services, PHP versions, and sites (e.g. `herd sites`, `herd services:start <service>`, `herd php:list`). Run `herd list` to discover all available commands.

=== laravel/core rules ===

# Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using `php artisan list` and check their parameters with `php artisan [command] --help`.
- If you're creating a generic PHP class, use `php artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `php artisan make:model --help` to check the available options.

## APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

## URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

## Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] {name}` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

## Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

=== laravel/v12 rules ===

# Laravel 12

- CRITICAL: ALWAYS use `search-docs` tool for version-specific Laravel documentation and updated code examples.
- Since Laravel 11, Laravel has a new streamlined file structure which this project uses.

## Laravel 12 Structure

- In Laravel 12, middleware are no longer registered in `app/Http/Kernel.php`.
- Middleware are configured declaratively in `bootstrap/app.php` using `Application::configure()->withMiddleware()`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- The `app/Console/Kernel.php` file no longer exists; use `bootstrap/app.php` or `routes/console.php` for console configuration.
- Console commands in `app/Console/Commands/` are automatically available and do not require manual registration.

## Database

- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 12 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models

- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.

=== pint/core rules ===

# Laravel Pint Code Formatter

- If you have modified any PHP files, you must run `vendor/bin/pint --dirty --format agent` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test --format agent`, simply run `vendor/bin/pint --format agent` to fix any formatting issues.

=== pest/core rules ===

## Pest

- This project uses Pest for testing. Create tests: `php artisan make:test --pest {name}`.
- The `{name}` argument should not include the test suite directory. Use `php artisan make:test --pest SomeFeatureTest` instead of `php artisan make:test --pest Feature/SomeFeatureTest`.
- Run tests: `php artisan test --compact` or filter: `php artisan test --compact --filter=testName`.
- Do NOT delete tests without approval.

</laravel-boost-guidelines>
