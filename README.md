# WaterFirst — Laravel 12

Marketing site and CMS for **WaterFirst Engineering Consultancy Private Limited** (Bangalore, Karnataka, India) — a water, wastewater and environmental engineering consultancy. Built on Laravel 12 with an admin panel.

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12, PHP 8.2+ |
| Frontend | Tailwind CSS v3, Alpine.js, Vite |
| Database | MySQL 8 |
| Auth | Laravel Breeze (admin only) |
| Images | Intervention Image v3 (WebP conversion) |
| Mail | Laravel Markdown Mail (queued) |
| SEO | Custom SeoService + polymorphic `seo_metas` table |
| Sitemap | Custom SitemapService + scheduled command |

## Features

### Public Site
- **Home page** — hero, stats, featured expertise, treatment focus, sectors grid, project record, software stack, CTA
- **Expertise** (`/expertise`) — listing + detail pages with SEO. `Service` is the internal model name; the public term is Expertise
- **Industries** — listing + filtered projects per sector
- **Projects** (`/case-studies`) — filterable grid (by category & industry), detail with gallery + PDF download
- **Insights** (`/insights`) — listing, category/tag filter, search, full article with related posts
- **Contact** — form with reCAPTCHA, auto-reply email, admin notification
- **Generic pages** — privacy policy, terms, careers, etc. (CMS-driven)
- **Sitemap** — dynamic XML sitemap with caching

### Admin Panel (`/admin`)
- **Dashboard** — stat cards, 30-day lead chart, latest leads
- **Blogs** — full CRUD, publish/draft toggle, featured flag, tag assignment, SEO fields
- **Blog Categories & Tags** — CRUD
- **Case Studies** — full CRUD, gallery upload, PDF upload, SEO fields
- **Case Study Categories** — CRUD
- **Industries** — CRUD with icon and image
- **Services** — full CRUD with SEO fields
- **Pages** — edit-only for fixed pages (hero, sections, SEO)
- **Leads** — filterable table, status management, CSV export
- **Settings** — tabbed form: general, contact, social, analytics (GA4/GTM)
- **Users** — CRUD for admin accounts

## Quick Start

```bash
cp .env.example .env
composer install
php artisan key:generate
# Edit .env with your DB credentials
php artisan migrate --seed
php artisan storage:link
npm install && npm run dev
php artisan serve
```

Admin: `http://localhost:8000/admin`
Credentials: printed during seeding.

## Directory Structure

```
app/
  Console/Commands/     SitemapGenerate, LeadsCleanup
  Http/Controllers/
    Admin/              AdminControllers.php (all admin resource controllers)
    Frontend/           FrontendControllers.php (all public controllers)
  Http/Middleware/      AdminMiddleware, SetSeoDefaults
  Http/Requests/        Frontend form requests
  Mail/                 NewLeadNotification, LeadConfirmation
  Models/               All Eloquent models
  Observers/            Blog, CaseStudy, Page observers
  Providers/            AppServiceProvider (registers all)
  Services/             SeoService, SitemapService, ImageService, LeadService
  View/Composers/       LayoutComposer, AdminLayoutComposer

database/
  migrations/           13 migration files
  seeders/              User, Setting, Page, Blog Category, Tag, Industry, Service, CS Category

resources/
  css/                  app.css, admin.css (Tailwind)
  js/                   app.js (Alpine + AJAX), admin.js
  views/
    layouts/            app.blade.php, admin.blade.php
    frontend/           All public pages + partials
    admin/              All admin CRUD views
    emails/             Lead notification templates
    sitemap/            XML template
```
