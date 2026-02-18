# Somaticx Portfolio Website - AI Agent Instructions

> Instructions for AI agents working on this Laravel 12 portfolio website.

## Architecture

**Stack:** Laravel 12 (PHP 8.2+), Blade, Alpine.js v3, Tailwind CSS v4, GSAP, Pest 3

**Pattern:** Service Layer - Controllers delegate to Services for business logic:
```php
public function __construct(private ContactService $contactService) {}
```

**Key directories:**
- `app/Services/` - Business logic (ContactService, ProjectService, SeoService)
- `app/Http/Requests/` - Form validation classes (never validate in controllers)
- `tests/Arch.php` - Architecture tests enforcing patterns

## Must-Follow Conventions

**PHP Requirements (enforced by `tests/Arch.php`):**
- `declare(strict_types=1);` at top of all PHP files
- No `dd()`, `dump()`, `ray()` calls
- Controllers must have `Controller` suffix
- Services must have documented methods

**Model Patterns:**
- Use `casts()` method not `$casts` property: `protected function casts(): array`
- Define query scopes: `scopePublished()`, `scopeFeatured()`, `scopeUnread()`
- Use `Model::query()` not `DB::table()`
- Route model binding uses slug: `{project:slug}`, `{service:slug}`

**SRS Requirements:** Reference requirements in PHPDoc comments:
```php
/** SRS Requirements: FR-021, FR-022 */
public function index(): View
```

## Commands

```bash
composer run dev      # Starts server + queue + Vite concurrently
composer run test     # Run full test suite
vendor/bin/pint --dirty  # Format changed PHP files only
php artisan make:test --pest {Name}  # Create feature test
```

## Testing (Pest 3)

```php
beforeEach(function () {
    Mail::fake();
    Service::factory()->create(['title' => 'Website Development']);
});

it('stores contact inquiry successfully', function () {
    $response = $this->postJson(route('contact.store'), [/* data */]);
    $response->assertStatus(201);
    expect(ContactInquiry::count())->toBe(1);
});
```

- Feature tests: `tests/Feature/` for controller/route tests
- Unit tests: `tests/Unit/` for service class tests
- Always use factories, use factory states when available

## Routes

Admin routes defined in `routes/admin.php`, prefixed with `/admin`, require auth.
Registered in `bootstrap/app.php` via `withRouting()` callback.

Public routes:
- `/`, `/about`, `/services`, `/portfolio`, `/contact` → public views
- `POST /contact` → rate-limited (3/hour/IP via `throttle:contact`)

## Design Tokens (from SRS)

```css
--color-accent: #6C63FF;       /* Primary purple */
--color-accent-2: #00D4FF;     /* Cyan accent */
--color-bg-primary: #0D0D0D;   /* Near-black */
--color-bg-surface: #111827;   /* Card backgrounds */
```

## Key Files

| File | Purpose |
|------|---------|
| [docs/Somaticx_SRS_v1.0.md](docs/Somaticx_SRS_v1.0.md) | Requirements (FR-xxx references) |
| [docs/STEP_*.md](docs/) | Implementation guides |
| [bootstrap/app.php](bootstrap/app.php) | Routing, middleware config |
| [tests/Arch.php](tests/Arch.php) | Architecture constraints |

## Git

Branch: `abrar` or feature branches. Commits: `feat:`, `fix:`, `test:`, `docs:`
