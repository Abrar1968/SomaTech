# Contributing to Somaticx Portfolio Website

> **Document Version:** 1.0.0 | **Last Updated:** February 2026

This guide provides instructions for developers contributing to the Somaticx Portfolio Website project.

---

## Table of Contents

1. [Technology Stack](#technology-stack)
2. [Getting Started](#getting-started)
3. [Architecture Overview](#architecture-overview)
4. [Development Workflow](#development-workflow)
5. [Code Style & Standards](#code-style--standards)
6. [Testing Requirements](#testing-requirements)
7. [Commit Guidelines](#commit-guidelines)
8. [Implementation Roadmap](#implementation-roadmap)

---

## Technology Stack

### Backend
| Technology | Version | Purpose |
|---|---|---|
| PHP | 8.2+ | Runtime |
| Laravel Framework | 12.x | MVC Framework |
| MySQL | 8.0+ | Database |
| Pest PHP | v3.x | Testing |
| Laravel Pint | v1.x | Code formatting |

### Frontend
| Technology | Purpose |
|---|---|
| Laravel Blade | Templating |
| Alpine.js v3 | Reactive UI state |
| Tailwind CSS v4 | Utility-first CSS |
| GSAP + ScrollTrigger | Animations |
| Three.js | WebGL hero canvas |
| Swiper.js | Carousels |
| GLightbox | Image lightbox |
| vanilla-tilt.js | 3D card tilt effects |

---

## Getting Started

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+ with npm
- MySQL 8.0+

### Initial Setup

```bash
# Clone the repository
git clone https://github.com/Abrar1968/Somaticx.git
cd Somaticx

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Run migrations and seeders
php artisan migrate:fresh --seed

# Build frontend assets
npm run build

# Start development server (option 1 - separate terminals)
php artisan serve
npm run dev

# Start development server (option 2 - combined)
composer run dev
```

---

## Architecture Overview

### Directory Structure

| Path | Purpose |
|---|---|
| `app/Http/Controllers/` | Thin route controllers - delegates to services |
| `app/Services/` | Business logic layer |
| `app/Models/` | Eloquent models with relationships and scopes |
| `app/Http/Requests/` | Form request validation classes |
| `resources/views/` | Blade templates and components |
| `resources/views/components/` | Reusable Blade components |
| `resources/views/pages/` | Full page views |
| `resources/views/layouts/` | Layout templates |
| `resources/views/admin/` | Admin dashboard views |
| `resources/css/app.css` | Tailwind CSS entry file |
| `resources/js/app.js` | JavaScript entry file |
| `resources/js/animations/` | Modular GSAP animation files |
| `routes/web.php` | Public routes |
| `routes/admin.php` | Admin routes (auth-protected) |

### Service Layer Pattern

Controllers should remain **thin** - all business logic belongs in Service classes:

```php
// ✅ Good - Controller delegates to service
public function store(StoreContactRequest $request): JsonResponse
{
    $inquiry = $this->contactService->storeInquiry($request->validated());
    return response()->json(['success' => true], 201);
}

// ❌ Bad - Business logic in controller
public function store(StoreContactRequest $request): JsonResponse
{
    $inquiry = ContactInquiry::create($request->validated());
    Mail::queue(new AdminNotificationMail($inquiry));
    return response()->json(['success' => true], 201);
}
```

### Database Models

All models must have:
- `declare(strict_types=1)` at file start
- PHPDoc `@property` annotations for all columns
- Cast definitions in `casts()` method
- Relationships defined as methods with return types
- Scopes for common query patterns

---

## Development Workflow

### Branch Strategy

| Branch | Purpose |
|---|---|
| `main` | Production-stable (default) |
| `develop` | Integration branch |
| `feature/*` | Individual feature branches |
| `bugfix/*` | Bug fix branches |

### Creating a Feature

```bash
# Create feature branch from develop
git checkout develop
git pull origin develop
git checkout -b feature/your-feature-name

# Work on your feature
# ... make changes ...

# Format code
vendor/bin/pint

# Run tests
php artisan test --compact

# Commit and push
git add .
git commit -m "feat: description of feature"
git push origin feature/your-feature-name

# Create Pull Request to develop
```

---

## Code Style & Standards

### PHP (PSR-12)

- **Always** run `vendor/bin/pint --dirty` before committing
- Use constructor property promotion
- Always declare explicit return types
- Use type hints for method parameters
- Prefer PHPDoc blocks over inline comments

```php
// ✅ Good
public function __construct(
    private ContactService $contactService
) {}

public function getAllPublished(?int $categoryId = null): Collection
{
    return Project::published()
        ->when($categoryId, fn ($q) => $q->byCategory($categoryId))
        ->latest()
        ->get();
}
```

### Blade Templates

- Use component syntax (`<x-component />`) over `@include`
- Pass only required props to components
- **No database queries in Blade views**
- Use `{{ }}` for escaped output (always)
- Use `{!! !!}` only for trusted, sanitized HTML

### JavaScript

- Use ES6+ syntax
- Alpine.js for reactive UI state
- GSAP for animations
- Check `prefers-reduced-motion` before animations

```javascript
// ✅ Good - respects user preference
if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    gsap.from(element, { opacity: 0, y: 40 });
} else {
    element.style.opacity = 1;
}
```

### CSS (Tailwind)

- Use CSS custom properties (tokens) from `app.css`
- 8px base spacing unit (all spacing in multiples of 8)
- Mobile-first responsive design
- Dark-first color scheme

---

## Testing Requirements

### Running Tests

```bash
# Run all tests
php artisan test

# Run with compact output
php artisan test --compact

# Run specific test file
php artisan test --filter=ContactServiceTest

# Run with coverage
./vendor/bin/pest --coverage
```

### Test Structure

- **Unit tests** for Service classes (`tests/Unit/Services/`)
- **Feature tests** for HTTP endpoints (`tests/Feature/`)
- Use factories with states for model creation
- Use `Mail::fake()` for testing email dispatch

```php
// ✅ Good test example
it('stores a contact inquiry and dispatches email', function () {
    Mail::fake();
    
    $response = $this->postJson(route('contact.store'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'service_interest' => 'Website Development',
        'message' => 'I need a website for my business.',
    ]);
    
    $response->assertCreated()->assertJson(['success' => true]);
    
    $this->assertDatabaseHas('contact_inquiries', ['email' => 'john@example.com']);
    
    Mail::assertQueued(AdminNotificationMail::class);
});
```

### Coverage Targets

- Service classes: ≥ 80% coverage
- Controllers: Test all routes for 200/404/422/429 responses
- Models: Test scopes and relationships

---

## Commit Guidelines

Use [Conventional Commits](https://www.conventionalcommits.org/):

| Type | Description |
|---|---|
| `feat:` | New feature |
| `fix:` | Bug fix |
| `docs:` | Documentation only |
| `style:` | Formatting, no code change |
| `refactor:` | Code change without fixing bug or adding feature |
| `test:` | Adding or correcting tests |
| `chore:` | Maintenance tasks |

### Examples

```bash
git commit -m "feat: add contact form with Alpine.js validation"
git commit -m "fix: correct rate limiter threshold for contact endpoint"
git commit -m "docs: update README with setup instructions"
git commit -m "test: add unit tests for ProjectService"
```

---

## Implementation Roadmap

### Step 1: Foundation & Backend ✅
- Database migrations (9 tables)
- Eloquent models with relationships
- Service layer classes
- Form request validation
- Mail classes
- Routes setup
- Factories

### Step 2: Frontend Layout & UI
- Tailwind CSS configuration
- Layout templates (app, admin)
- All Blade components
- JavaScript setup
- Page views

### Step 3: Controllers & Integration
- Full controller implementations
- GSAP animations
- Sitemap generation
- Comprehensive test suite
- Final integration

---

## Design Specifications

### Color Palette

| Token | Hex | Usage |
|---|---|---|
| `--color-bg-primary` | `#0D0D0D` | Page background |
| `--color-bg-surface` | `#111827` | Card backgrounds |
| `--color-bg-elevated` | `#1F2937` | Elevated surfaces |
| `--color-accent` | `#6C63FF` | Primary accent (CTAs) |
| `--color-accent-2` | `#00D4FF` | Secondary accent (gradients) |
| `--color-text` | `#F9FAFB` | Primary text |
| `--color-text-muted` | `#9CA3AF` | Secondary text |
| `--color-border` | `#374151` | Borders |
| `--color-success` | `#10B981` | Success states |
| `--color-error` | `#EF4444` | Error states |

### Typography

| Role | Font | Weight |
|---|---|---|
| Display/Hero | Plus Jakarta Sans | 700-800 |
| Headings | Plus Jakarta Sans | 600-700 |
| Body | Inter | 400-500 |
| Code | JetBrains Mono | 400 |

### Spacing

All spacing uses **8px base unit** (8, 16, 24, 32, 48, 64, 96, 128px).

---

## Security Checklist

- [x] CSRF protection on all POST/PUT/DELETE routes
- [x] Rate limiting: 3 contact submissions/hour/IP
- [x] Rate limiting: 5 login attempts/10 minutes/IP
- [x] File upload validation (MIME type, 5MB limit)
- [x] SQL injection prevention via Eloquent ORM
- [x] XSS prevention via Blade `{{ }}` escaping
- [x] Admin routes protected by `auth` middleware
- [x] `.env` excluded from version control

---

## Questions?

Refer to the detailed documentation in `/docs/`:
- [Somaticx_SRS_v1.0.md](../docs/Somaticx_SRS_v1.0.md) - Full requirements
- [STEP_01_FOUNDATION_BACKEND.md](../docs/STEP_01_FOUNDATION_BACKEND.md)
- [STEP_02_FRONTEND_UI.md](../docs/STEP_02_FRONTEND_UI.md)
- [STEP_03_CONTROLLERS_INTEGRATION.md](../docs/STEP_03_CONTROLLERS_INTEGRATION.md)
