# Somaticx Portfolio Website - AI Agent Instructions

> This file provides instructions for AI coding assistants (GitHub Copilot, Claude, etc.) working on the Somaticx Portfolio Website project.

---

## Project Overview

**Somaticx** is a professional portfolio website for a web and app development agency. The system is built with Laravel 12, Tailwind CSS v4, Alpine.js v3, and MySQL 8.0+.

### Core Services
- Website Development & Maintenance
- App Development (iOS, Android, Cross-platform)

### Architecture
- **Backend:** Laravel 12 (PHP 8.2+)
- **Frontend:** Blade + Alpine.js + Tailwind CSS v4
- **Database:** MySQL 8.0+
- **Animations:** GSAP + ScrollTrigger + Three.js
- **Testing:** Pest 3

---

## Project Structure

```
app/
├── Http/
│   ├── Controllers/           # Public + Admin controllers
│   │   └── Admin/             # Admin-specific controllers
│   └── Requests/              # Form validation requests
├── Mail/                      # Mailable classes
├── Models/                    # Eloquent models
└── Services/                  # Business logic services

resources/
├── css/app.css                # Tailwind + SRS design tokens
├── js/
│   ├── app.js                 # Main frontend JS (Alpine + GSAP)
│   ├── admin.js               # Admin panel JS
│   └── animations/            # GSAP animation modules
└── views/
    ├── components/            # Blade components
    ├── layouts/               # app.blade.php, admin.blade.php
    ├── pages/                 # Public page views
    ├── admin/                 # Admin views
    └── emails/                # Email templates

tests/
├── Feature/                   # Feature/integration tests
├── Unit/                      # Unit tests
└── Arch.php                   # Architecture tests
```

---

## Coding Standards

### PHP / Laravel

1. **Use Service Layer Pattern** - Controllers delegate to Services:
   ```php
   public function __construct(private ContactService $contactService) {}
   ```

2. **Type Declarations** - Always use explicit types:
   ```php
   public function store(StoreContactRequest $request): JsonResponse
   ```

3. **Form Requests** - Validate in dedicated request classes, not controllers

4. **Return Types** - Document all methods with proper PHPDoc and return types

5. **Eloquent** - Use query scopes, avoid `DB::` facade:
   ```php
   // Good
   Project::featured()->limit(6)->get();
   
   // Avoid
   DB::table('projects')->where(...);
   ```

### Frontend / Blade

1. **Component-Based** - Use Blade components (`<x-component-name />`)

2. **Design Tokens** - Use CSS variables from SRS:
   ```css
   var(--color-accent)      /* #6C63FF */
   var(--color-bg-primary)  /* #0D0D0D */
   var(--color-text-muted)  /* #9CA3AF */
   ```

3. **Alpine.js** - Reactive UI with `x-data`, `x-show`, `x-intersect`

4. **GSAP** - Use `data-gsap` attributes for scroll animations:
   ```html
   <div data-gsap="fade-up" data-gsap-delay="0.2">
   ```

### Testing (Pest 3)

1. **Feature Tests** - Controller/route tests go in `tests/Feature/`
2. **Unit Tests** - Service class tests go in `tests/Unit/`
3. **Factories** - Always use model factories for test data
4. **Naming** - Use `it('does something')` convention

---

## Important Models

| Model | Key Relationships | Scopes |
|-------|------------------|--------|
| `Project` | belongsTo(Category), hasMany(Testimonial) | `featured()`, `published()` |
| `Service` | hasMany(Project) | `featured()` |
| `Testimonial` | belongsTo(Project) | `featured()` |
| `TeamMember` | - | `active()` |
| `ContactInquiry` | belongsTo(Service) | `unread()`, `recent()` |

---

## Routes Reference

### Public Routes
- `GET /` → HomeController@index
- `GET /about` → AboutController@index
- `GET /services` → ServiceController@index
- `GET /services/{service:slug}` → ServiceController@show
- `GET /portfolio` → PortfolioController@index
- `GET /portfolio/{project:slug}` → PortfolioController@show
- `GET /contact` → ContactController@index
- `POST /contact` → ContactController@store (rate-limited)
- `GET /sitemap.xml` → SitemapController@index

### Admin Routes (auth required)
- `GET /admin` → Admin\DashboardController@index
- Resource routes for: projects, services, team, testimonials, inquiries, skills, stats, settings

---

## SRS Design Tokens

The design follows the Software Requirements Specification (SRS) document. Key tokens:

```css
/* Colors */
--color-bg-primary: #0D0D0D    /* Near-black background */
--color-bg-surface: #111827    /* Card backgrounds */
--color-accent: #6C63FF        /* Primary accent (purple) */
--color-accent-2: #00D4FF      /* Secondary accent (cyan) */
--color-text: #F9FAFB          /* Primary text */
--color-text-muted: #9CA3AF    /* Secondary text */

/* Typography */
--font-display: "Plus Jakarta Sans"  /* Headings */
--font-body: "Inter"                 /* Body text */
```

---

## Common Commands

```bash
# Development
composer run dev          # Start dev server
npm run dev               # Vite dev server

# Testing
php artisan test          # Run all tests
php artisan test --filter=ContactController  # Filter tests

# Database
php artisan migrate:fresh --seed  # Reset + seed

# Code Quality
vendor/bin/pint           # Format PHP code
vendor/bin/pint --dirty   # Format only changed files
```

---

## Task Workflow

When implementing features:

1. **Check SRS** - Read `docs/Somaticx_SRS_v1.0.md` for requirements
2. **Check STEP files** - Follow implementation guides in `docs/STEP_*.md`
3. **Write Tests First** - Use Pest 3 conventions
4. **Use Services** - Business logic in `app/Services/`
5. **Format Code** - Run `vendor/bin/pint` before committing
6. **Run Tests** - Ensure `php artisan test` passes

---

## Git Conventions

- **Branch:** Work on `abrar` or feature branches
- **Commits:** Use conventional commits: `feat:`, `fix:`, `test:`, `docs:`
- **Example:** `feat(admin): Add project CRUD functionality`

---

## Admin Features

The admin dashboard (`/admin`) provides CRUD for:
- Projects (with soft delete/restore)
- Services
- Team Members
- Testimonials
- Contact Inquiries (read-only, mark as read)
- Skills
- Statistics
- Site Settings

---

## Security Notes

- Contact form is rate-limited (3 submissions/hour/IP)
- Admin routes require authentication
- CSRF protection on all forms
- File uploads validated and stored in `storage/app/public`
- Admin views have `noindex, nofollow` meta tags

---

## Key Files to Reference

| File | Purpose |
|------|---------|
| `docs/Somaticx_SRS_v1.0.md` | Full requirements document |
| `docs/STEP_01_FOUNDATION_BACKEND.md` | Backend implementation guide |
| `docs/STEP_02_FRONTEND_UI.md` | Frontend implementation guide |
| `docs/STEP_03_CONTROLLERS_INTEGRATION.md` | Controllers & testing guide |
| `routes/web.php` | All route definitions |
| `resources/css/app.css` | Design tokens & utilities |

---

*Last Updated: February 2026*
