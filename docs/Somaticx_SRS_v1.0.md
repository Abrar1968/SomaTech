# Somaticx Portfolio Website
## Software Requirements Specification
### Version 1.0.0 · February 2026

---

| Field | Value |
|---|---|
| Document Version | 1.0.0 |
| Status | Final Draft |
| Prepared By | Somaticx Technical Team |
| Date | February 2026 |
| Confidentiality | Internal — Restricted |

---

## Table of Contents

1. [Introduction](#1-introduction)
2. [Overall Description](#2-overall-description)
3. [System Architecture](#3-system-architecture)
4. [Database Design](#4-database-design)
5. [Functional Requirements](#5-functional-requirements)
6. [UI/UX Design Specifications](#6-uiux-design-specifications)
7. [Non-Functional Requirements](#7-non-functional-requirements)
8. [Technology Stack](#8-technology-stack)
9. [Blade Component Architecture](#9-blade-component-architecture)
10. [Testing Requirements](#10-testing-requirements)
11. [Deployment & Infrastructure](#11-deployment--infrastructure)
12. [Implementation Roadmap](#12-implementation-roadmap)
13. [Appendix](#13-appendix)

---

## 1. Introduction

### 1.1 Purpose

This Software Requirements Specification (SRS) defines all requirements for the Somaticx Portfolio Website. It serves as the authoritative reference for designers, developers, testers, and stakeholders throughout the complete software development lifecycle. Every functional behaviour, non-functional constraint, UI/UX expectation, database schema, and deployment criterion is documented here so the resulting product meets industry standards for top-tier IT firm portfolios.

### 1.2 Scope

The Somaticx Portfolio Website is a publicly accessible, full-stack web application serving two purposes: first, to establish Somaticx's digital brand authority; and second, to convert visitors into qualified project leads. The system specialises in **Website Development & Maintenance** and **App Development**. It comprises three logical layers — a public-facing frontend built with Laravel Blade, Alpine.js, and Tailwind CSS v4; a secure admin dashboard for content management; and a MySQL-backed Laravel application layer. The site must function flawlessly across all modern browsers and device form factors, delivering sub-2-second load times and WCAG 2.1 AA accessibility compliance.

### 1.3 Definitions and Acronyms

| Term / Acronym | Definition |
|---|---|
| SRS | Software Requirements Specification — this document |
| MVC | Model-View-Controller architectural pattern used by Laravel |
| ORM | Object-Relational Mapping — Laravel Eloquent is the ORM used |
| CMS | Content Management System — the admin dashboard component |
| GSAP | GreenSock Animation Platform — premier JavaScript animation library |
| Alpine.js | Lightweight reactive JavaScript framework for Blade template interactivity |
| TW v4 | Tailwind CSS version 4, utility-first CSS framework (pre-configured) |
| WCAG | Web Content Accessibility Guidelines 2.1 Level AA |
| CSP | Content Security Policy — HTTP security header |
| LCP | Largest Contentful Paint — Core Web Vital performance metric |
| CLS | Cumulative Layout Shift — Core Web Vital stability metric |
| CTA | Call to Action — a clickable button or link prompting user action |
| JSON-LD | JSON Linked Data — format for structured SEO schema markup |

### 1.4 Document Conventions

Requirements use unique identifiers with the pattern `[PREFIX-###]`. Prefix codes are: **FR** (Functional Requirement), **NFR** (Non-Functional Requirement), **UI** (User Interface), **SEC** (Security). Priority keywords follow RFC 2119: **MUST** indicates a mandatory requirement; **SHOULD** indicates a strong preference; **MAY** indicates an optional enhancement.

### 1.5 References

- Laravel 12 Official Documentation — https://laravel.com/docs/12.x
- Tailwind CSS v4 Documentation — https://tailwindcss.com
- Alpine.js v3 Documentation — https://alpinejs.dev
- GSAP 3 + ScrollTrigger — https://gsap.com/docs
- WCAG 2.1 Guidelines — https://www.w3.org/TR/WCAG21
- Google Core Web Vitals — https://web.dev/vitals
- IEEE 830-1998 Standard for SRS

---

## 2. Overall Description

### 2.1 Product Perspective

The Somaticx Portfolio Website is a standalone product. It integrates with external services including a transactional email provider (SMTP / Mailgun / SendGrid), Google Analytics 4 for visitor analytics, reCAPTCHA v3 for form protection, and a CDN for static asset delivery. The admin dashboard operates behind Laravel's built-in authentication and is accessible only to authorised Somaticx personnel. The public frontend has no user registration — it is a read-only showcase with a single contact submission channel.

### 2.2 Target Users

| User Class | Description | Primary Goals |
|---|---|---|
| Prospective Client | Businesses or individuals seeking web / app development | Evaluate Somaticx, view portfolio, initiate contact |
| Recruiter / Partner | Talent scouts, business partners, investors | Assess tech stack, team capability, and credibility |
| Admin / Content Editor | Somaticx internal staff managing website content | Add/edit projects, update team info, manage inquiries |

### 2.3 Product Functions Summary

At the highest level, the Somaticx Portfolio Website: (1) presents Somaticx's brand identity through an animated, visually stunning hero section; (2) showcases a filterable portfolio of completed projects across web and app development; (3) communicates service offerings with dedicated service pages; (4) builds client trust through testimonials, statistics counters, and team profiles; (5) captures leads via a fully validated, rate-limited contact form; (6) provides a full admin dashboard for content management; and (7) delivers measurable SEO value through structured metadata, canonical URLs, JSON-LD schema, and auto-generated sitemaps.

### 2.4 Assumptions and Constraints

- `[CONST-001]` Backend framework is fixed at Laravel (latest stable on PHP 8.2+).
- `[CONST-002]` Frontend uses Blade templating, Alpine.js, and Tailwind CSS v4. No separate SPA framework (React/Vue) is used on the public frontend.
- `[CONST-003]` Database is MySQL 8.0+. No NoSQL or alternative RDBMS is permitted.
- `[CONST-004]` Tailwind CSS v4 is already configured in the project; no additional setup step is needed.
- `[CONST-005]` GSAP with ScrollTrigger and SplitText plugins is used for all advanced animations.
- `[CONST-006]` All animations MUST respect the `prefers-reduced-motion` media query and degrade to instant transitions.
- `[CONST-007]` The admin panel MUST NOT be publicly indexable (robots `noindex, nofollow`).

---

## 3. System Architecture

### 3.1 Architecture Overview

The system follows Laravel's MVC pattern augmented with a **Service Layer** to keep controllers thin and business logic reusable. Reading from client to database: the **Browser/Client** layer renders HTML, CSS, and Alpine.js reactive components delivered via Blade views. The **Application Layer** contains Laravel controllers, middleware, and FormRequest validators. The **Service Layer** holds business logic classes (`ContactService`, `ProjectService`, `SeoService`, etc.) that controllers delegate to. The **Data Layer** uses Eloquent models mapped to MySQL tables. The **Infrastructure Layer** encompasses Laravel Cache (Redis-backed in production), Laravel Queues for async email dispatch, and Laravel Storage for uploaded media.

### 3.2 Directory Structure

| Path | Purpose |
|---|---|
| `app/Http/Controllers/` | Route controllers — thin, delegates to service classes |
| `app/Services/` | Business logic: ContactService, ProjectService, SeoService, etc. |
| `app/Models/` | Eloquent models with relationships, scopes, and accessors |
| `app/Http/Requests/` | Form request validation classes (StoreContactRequest, etc.) |
| `resources/views/` | Blade templates and components root |
| `resources/views/components/` | Reusable Blade components (x-nav, x-hero, x-project-card, etc.) |
| `resources/views/pages/` | Full page views (home, about, services, portfolio, contact) |
| `resources/views/admin/` | Admin dashboard Blade views |
| `resources/css/app.css` | Tailwind CSS v4 entry file — `@import` directives only |
| `resources/js/app.js` | Alpine.js bootstrap + GSAP animation orchestrator |
| `resources/js/animations/` | Modular animation files (hero.js, scroll.js, cursor.js, etc.) |
| `public/build/` | Vite-compiled, fingerprinted CSS and JS bundles |
| `database/migrations/` | All database migration files in chronological order |
| `database/seeders/` | Demo data seeders for rapid development bootstrapping |
| `routes/web.php` | Public web routes |
| `routes/admin.php` | Admin-prefixed, auth-protected routes |

### 3.3 Routing Design

| Route | Method | Controller@Method | Description |
|---|---|---|---|
| `/` | GET | `HomeController@index` | Landing / Hero page |
| `/about` | GET | `AboutController@index` | About Somaticx page |
| `/services` | GET | `ServiceController@index` | All services listing |
| `/services/{slug}` | GET | `ServiceController@show` | Single service detail |
| `/portfolio` | GET | `PortfolioController@index` | Filterable project gallery |
| `/portfolio/{slug}` | GET | `PortfolioController@show` | Single project case study |
| `/contact` | GET | `ContactController@index` | Contact form page |
| `/contact` | POST | `ContactController@store` | Submit contact inquiry |
| `/sitemap.xml` | GET | `SitemapController@index` | Auto-generated XML sitemap |
| `/admin` | GET | `Admin\DashboardController` | Admin KPI overview |
| `/admin/projects/*` | GET/POST/PUT/DEL | `Admin\ProjectController` | Project CRUD operations |
| `/admin/inquiries` | GET | `Admin\InquiryController` | View contact submissions |
| `/admin/team` | GET/POST/PUT/DEL | `Admin\TeamController` | Team member management |
| `/admin/settings` | GET/POST | `Admin\SettingsController` | Site settings management |

---

## 4. Database Design

### 4.1 Entity Relationship Overview

The MySQL database is designed to 3NF (Third Normal Form) for data integrity, with strategic denormalisation via JSON columns for array-type data (tech stacks, image galleries, feature lists) that do not require relational querying. All tables use Laravel's standard `created_at` and `updated_at` timestamps managed automatically by Eloquent. Foreign key constraints are enforced at the database level with CASCADE delete where appropriate. Every table has a primary key of `BIGINT UNSIGNED AUTO_INCREMENT`.

### 4.2 Table: `projects`

> Stores all portfolio case study projects. Status controls visibility: `draft` (hidden), `published`, or `featured` (shown on homepage).

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| `title` | VARCHAR(255) | NOT NULL | Project display name |
| `slug` | VARCHAR(255) | NOT NULL, UNIQUE | URL-friendly identifier, auto-generated from title |
| `category_id` | BIGINT UNSIGNED | FK → categories.id | Project category |
| `short_description` | VARCHAR(500) | NOT NULL | Card teaser text (max 500 chars) |
| `description` | LONGTEXT | NOT NULL | Full Markdown-formatted project description |
| `client_name` | VARCHAR(255) | NULLABLE | Client name or "Confidential" |
| `tech_stack` | JSON | NULLABLE | Array of technology strings used in project |
| `project_url` | VARCHAR(500) | NULLABLE | Live production URL |
| `github_url` | VARCHAR(500) | NULLABLE | Repository link (optional) |
| `thumbnail` | VARCHAR(500) | NOT NULL | Primary card thumbnail image path (WebP) |
| `gallery` | JSON | NULLABLE | Array of additional screenshot image paths |
| `status` | ENUM('draft','published','featured') | DEFAULT draft | Visibility and homepage feature control |
| `start_date` | DATE | NULLABLE | Project start date |
| `end_date` | DATE | NULLABLE | Project completion date |
| `sort_order` | SMALLINT | DEFAULT 0 | Manual display ordering (lower = first) |
| `meta_title` | VARCHAR(255) | NULLABLE | SEO title override for project detail page |
| `meta_description` | VARCHAR(500) | NULLABLE | SEO meta description override |
| `created_at` | TIMESTAMP | AUTO | Eloquent managed |
| `updated_at` | TIMESTAMP | AUTO | Eloquent managed |

> **Indexes:** `slug` (UNIQUE), `category_id` (INDEX), `status` (INDEX), `sort_order` (INDEX).

### 4.3 Table: `categories`

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| `name` | VARCHAR(100) | NOT NULL, UNIQUE | Category display name (e.g., Website Development) |
| `slug` | VARCHAR(100) | NOT NULL, UNIQUE | Filter slug (e.g., website-development) |
| `icon` | VARCHAR(255) | NULLABLE | Icon class or inline SVG identifier |
| `created_at` | TIMESTAMP | AUTO | Auto-managed by Eloquent |
| `updated_at` | TIMESTAMP | AUTO | Auto-managed by Eloquent |

### 4.4 Table: `services`

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| `title` | VARCHAR(255) | NOT NULL | Service name |
| `slug` | VARCHAR(255) | NOT NULL, UNIQUE | URL slug for service detail page |
| `tagline` | VARCHAR(300) | NULLABLE | Short marketing one-liner |
| `description` | LONGTEXT | NOT NULL | Detailed Markdown service description |
| `icon` | VARCHAR(255) | NULLABLE | Icon identifier (SVG name or class) |
| `features` | JSON | NULLABLE | Array of feature bullet point strings |
| `technologies` | JSON | NULLABLE | Array of related technology names |
| `is_featured` | BOOLEAN | DEFAULT false | Show prominently on homepage services section |
| `sort_order` | SMALLINT | DEFAULT 0 | Display ordering |
| `created_at` | TIMESTAMP | AUTO | Auto-managed |
| `updated_at` | TIMESTAMP | AUTO | Auto-managed |

### 4.5 Table: `team_members`

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| `name` | VARCHAR(255) | NOT NULL | Full name of team member |
| `role` | VARCHAR(255) | NOT NULL | Job title / role |
| `bio` | TEXT | NULLABLE | Short biography paragraph |
| `photo` | VARCHAR(500) | NULLABLE | Profile photo path (WebP, stored via Laravel Storage) |
| `linkedin_url` | VARCHAR(500) | NULLABLE | LinkedIn profile URL |
| `github_url` | VARCHAR(500) | NULLABLE | GitHub profile URL |
| `skills` | JSON | NULLABLE | Array of skill/technology strings |
| `sort_order` | SMALLINT | DEFAULT 0 | Display ordering on team page |
| `is_active` | BOOLEAN | DEFAULT true | Toggle visibility without deleting record |
| `created_at` | TIMESTAMP | AUTO | Auto-managed |
| `updated_at` | TIMESTAMP | AUTO | Auto-managed |

### 4.6 Table: `testimonials`

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| `client_name` | VARCHAR(255) | NOT NULL | Reviewer full name |
| `client_company` | VARCHAR(255) | NULLABLE | Reviewer company name |
| `client_role` | VARCHAR(255) | NULLABLE | Reviewer job title |
| `client_photo` | VARCHAR(500) | NULLABLE | Reviewer photo path (fallback to initials avatar) |
| `content` | TEXT | NOT NULL | Full testimonial text |
| `rating` | TINYINT UNSIGNED | DEFAULT 5 | Star rating (1–5) |
| `project_id` | BIGINT UNSIGNED | FK → projects.id NULLABLE | Linked project (for context) |
| `is_featured` | BOOLEAN | DEFAULT false | Include in homepage carousel |
| `sort_order` | SMALLINT | DEFAULT 0 | Display ordering |
| `created_at` | TIMESTAMP | AUTO | Auto-managed |
| `updated_at` | TIMESTAMP | AUTO | Auto-managed |

### 4.7 Table: `contact_inquiries`

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| `name` | VARCHAR(255) | NOT NULL | Sender full name |
| `email` | VARCHAR(255) | NOT NULL | Sender email address |
| `phone` | VARCHAR(30) | NULLABLE | Phone number |
| `company` | VARCHAR(255) | NULLABLE | Sender company name |
| `service_interest` | VARCHAR(100) | NULLABLE | Service they are inquiring about |
| `budget_range` | VARCHAR(100) | NULLABLE | Approximate budget bracket |
| `message` | TEXT | NOT NULL | Full message body (min 20 chars) |
| `ip_address` | VARCHAR(45) | NULLABLE | Submitter IP (IPv4/IPv6) for spam prevention |
| `status` | ENUM('new','read','replied','archived') | DEFAULT new | Admin workflow status |
| `read_at` | TIMESTAMP | NULLABLE | First opened by admin timestamp |
| `replied_at` | TIMESTAMP | NULLABLE | Admin replied timestamp |
| `created_at` | TIMESTAMP | AUTO | Submission timestamp |
| `updated_at` | TIMESTAMP | AUTO | Auto-managed |

### 4.8 Table: `skills`

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| `name` | VARCHAR(100) | NOT NULL | Skill / technology display name |
| `category` | VARCHAR(100) | NULLABLE | Grouping label (e.g., Frontend, Backend, Mobile) |
| `proficiency` | TINYINT UNSIGNED | DEFAULT 100 | Proficiency percentage (0–100) for animated bars |
| `icon` | VARCHAR(255) | NULLABLE | Logo path or icon class |
| `sort_order` | SMALLINT | DEFAULT 0 | Display order within category |

### 4.9 Table: `stats`

> Company achievement metrics displayed with animated counters on the homepage.

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK, AUTO_INCREMENT | Primary key |
| `label` | VARCHAR(255) | NOT NULL | Display label (e.g., "Projects Delivered") |
| `value` | INT UNSIGNED | NOT NULL | Numeric counter target value |
| `prefix` | VARCHAR(20) | NULLABLE | String before number (e.g., "$") |
| `suffix` | VARCHAR(20) | NULLABLE | String after number (e.g., "+" or "K") |
| `icon` | VARCHAR(255) | NULLABLE | Icon identifier for the stat card |
| `sort_order` | SMALLINT | DEFAULT 0 | Display ordering |

### 4.10 Table: `site_settings`

> Key-value store for all dynamic site configuration editable from the admin panel.

| Column | Type | Constraints | Description |
|---|---|---|---|
| `id` | BIGINT UNSIGNED | PK | Primary key |
| `key` | VARCHAR(255) | NOT NULL, UNIQUE | Setting identifier (e.g., `site.tagline`) |
| `value` | LONGTEXT | NULLABLE | Setting value |
| `group` | VARCHAR(100) | DEFAULT general | Admin panel grouping (general, seo, social, etc.) |
| `type` | ENUM('text','textarea','image','boolean','json') | DEFAULT text | Value data type for admin form rendering |

---

## 5. Functional Requirements

### 5.1 Homepage (`/`)

#### 5.1.1 Hero Section

**`[FR-001]`** The homepage MUST render a full-viewport animated Hero Section as the first visible element. The hero MUST include: an animated typewriter or morphing text headline cycling through Somaticx's core services; a value proposition sub-headline; two primary CTAs ("View Our Work" → `/portfolio` and "Start a Project" → `/contact`); and an interactive particle-mesh or Three.js WebGL background canvas that responds to mouse movement.

**`[FR-002]`** A scroll-down indicator (chevron/arrow) MUST animate with a looping bounce or pulse at the bottom of the hero viewport and scroll the page smoothly on click.

#### 5.1.2 Tech Marquee

**`[FR-003]`** An infinite horizontally scrolling marquee MUST display client logos or technology icons using pure CSS animation (no JS dependency for scroll). The marquee MUST pause on mouse hover. A second row scrolling in the opposite direction is recommended for visual depth.

#### 5.1.3 Services Overview

**`[FR-004]`** The Services section MUST display the three featured services as animated glassmorphism cards. Each card MUST reveal on scroll using GSAP ScrollTrigger with staggered fade-up-scale animation. Cards MUST respond to hover with a 3D perspective tilt effect (vanilla-tilt.js or CSS perspective transform + Alpine.js).

#### 5.1.4 Featured Projects

**`[FR-005]`** A "Featured Projects" section MUST display up to 6 projects with `status = "featured"`, ordered by `sort_order`. Each project card MUST show thumbnail, title, category badge, and short description. On hover, a smooth overlay MUST slide up from the bottom of the card revealing a "View Case Study" CTA with animated arrow.

#### 5.1.5 Statistics Counter

**`[FR-006]`** An animated statistics section MUST display company metrics from the `stats` table. Each counter MUST animate from 0 to its target value when the section enters the viewport, driven by GSAP CountUp or a custom Alpine.js counter using `requestAnimationFrame`. Prefix/suffix values MUST be appended correctly.

#### 5.1.6 Testimonials Carousel

**`[FR-007]`** A testimonials carousel MUST display featured testimonials with 5-second auto-play, manual dot navigation, and mobile swipe gesture support (via Swiper.js or equivalent). Each slide MUST show client photo (or initials avatar fallback), name, company, role, star rating rendered as filled SVG stars, and testimonial text.

#### 5.1.7 Technology Stack

**`[FR-008]`** A technology stack section MUST display skill logos from the `skills` table in an animated grid or horizontal scroll. Each technology logo MUST have a hover tooltip displaying the skill name and proficiency percentage.

### 5.2 About Page (`/about`)

**`[FR-009]`** The About page MUST open with a page-hero containing an animated gradient headline and a split-screen layout (text left, animated illustration or 3D graphic right) with GSAP staggered entrance animations.

**`[FR-010]`** A company milestone timeline MUST display key dates and achievements in a vertical timeline, each milestone revealing sequentially on scroll with GSAP ScrollTrigger.

**`[FR-011]`** A "Meet the Team" section MUST render each active `team_member` record as a 3D CSS flip card: front face shows photo, name, and role; back face (revealed on hover with CSS `rotateY 180deg`) shows bio excerpt and social media links with smooth icon hover transitions.

**`[FR-012]`** A "Our Values" section MUST display core company values as icon cards where the SVG icon path animates (draws itself) when scrolled into view.

### 5.3 Services Pages (`/services` and `/services/{slug}`)

**`[FR-013]`** The Services index page MUST display all services in an alternating layout (image-left/text-right, then text-left/image-right) with staggered scroll-reveal animations on each row.

**`[FR-014]`** Each service on the index page MUST link to its dedicated detail page (`/services/{slug}`) which displays: full Markdown-rendered description, feature list with animated check marks, related technology badges, and a prominent CTA to contact about that specific service.

**`[FR-015]`** A "Project Delivery Process" section on the services index MUST visualise the workflow as a horizontal multi-step diagram with GSAP sequential reveal animations (connector lines draw in, step nodes scale up, text fades in).

**`[FR-016]`** A floating "Get a Quote" action button MUST be persistently visible on service pages (fixed position, bottom-right) with a subtle pulsing animation. On click it scrolls to or links to the contact form.

### 5.4 Portfolio Page (`/portfolio`)

**`[FR-017]`** The Portfolio index MUST display all published and featured projects in a responsive grid. Projects MUST be filterable by category without page reload using Alpine.js reactive state. Filter transitions MUST animate with `opacity` and `transform (translateY)` changes on the project cards.

**`[FR-018]`** Active category filter buttons MUST display a pill/underline indicator that animates to the selected button using CSS transforms. No page reload must occur during filtering.

**`[FR-019]`** Each project card MUST display: thumbnail with lazy loading and explicit dimensions, category badge with colour coding, project title, short description, and a "View Case Study" hover overlay that slides up with the Alpine.js `x-show` directive and CSS transition.

**`[FR-020]`** The Portfolio detail page (`/portfolio/{slug}`) MUST include: hero image with parallax, project metadata sidebar (client, date, tech stack badges, live URL, GitHub URL), full Markdown-rendered description with proper heading hierarchy, an image gallery powered by GLightbox for lightbox viewing, and "Previous Project" / "Next Project" navigation links.

### 5.5 Contact Page (`/contact`)

**`[FR-021]`** The Contact page MUST use a two-column split layout on desktop: left column shows contact information (email, social links, map or abstract visual) with staggered GSAP entrance animations; right column contains the contact form.

**`[FR-022]`** The contact form MUST include these fields: Full Name (required), Email Address (required, validated), Phone Number (optional), Company Name (optional), Service of Interest (required, `<select>` populated from the `services` table), Budget Range (optional, `<select>`), and Message (required, minimum 20 characters, live character counter displayed).

**`[FR-023]`** Real-time client-side validation MUST be implemented using Alpine.js. Error messages MUST animate into view below each invalid field (CSS `max-height` transition from 0 to auto). Field borders MUST turn the error colour on invalid state and return to normal on correction.

**`[FR-024]`** On successful AJAX submission, the form MUST be replaced with a success state showing a Lottie or CSS-animated checkmark SVG, a thank-you heading, and the submitted name interpolated into the message. No page reload should occur.

**`[FR-025]`** The `ContactController` MUST: validate via `StoreContactRequest` (server-side), store to `contact_inquiries`, dispatch a queued `AdminNotificationMail`, and return a JSON response `{success: true}` with HTTP 201. Rate limiting MUST apply: **max 3 submissions per IP per hour** via Laravel `RateLimiter`.

### 5.6 Admin Dashboard

**`[FR-026]`** Admin authentication MUST use Laravel's built-in session-based auth with email + password. The login page MUST be at `/admin/login`. Session regeneration MUST occur on login to prevent session fixation attacks.

**`[FR-027]`** The admin dashboard homepage MUST display KPI cards: total projects count, new unread inquiries (count + oldest date), active team members, and a chart of inquiries over the last 30 days.

**`[FR-028]`** The Projects CRUD module MUST support: create with thumbnail upload (WebP auto-converted via Spatie MediaLibrary), gallery image upload (multi-select), SimpleMDE or TipTap markdown editor, tech stack tag input, and all fields from the `projects` schema. List view MUST offer column sorting, status badge filter, and keyword search. Soft delete with recoverable Trash section MUST be implemented using Laravel's `SoftDeletes` trait.

**`[FR-029]`** The Inquiries module MUST display all `contact_inquiries` in a paginated table (20 per page, sorted by `created_at` DESC). Clicking a row MUST open a detail view and atomically update `status` to `"read"` with `read_at` timestamp set.

**`[FR-030]`** Full CRUD admin modules MUST exist for: Team Members, Testimonials, Services, Skills, Stats, and Site Settings.

---

## 6. UI/UX Design Specifications

### 6.1 Design Philosophy

The Somaticx website uses a **dark-first design approach** — a near-black background (`#0D0D0D`) with vibrant accent colours — projecting technical sophistication, modernity, and premium quality consistent with award-winning IT agency aesthetics. The visual language combines glassmorphism cards, gradient text effects, animated borders, and depth-layered backgrounds to create a high-impact first impression.

### 6.2 Colour Palette

| CSS Token | Hex Value | RGB | Usage |
|---|---|---|---|
| `--color-bg-primary` | `#0D0D0D` | rgb(13,13,13) | Page background, ultimate dark base |
| `--color-bg-surface` | `#111827` | rgb(17,24,39) | Card and component backgrounds |
| `--color-bg-elevated` | `#1F2937` | rgb(31,41,55) | Elevated cards, hover states |
| `--color-accent` | `#6C63FF` | rgb(108,99,255) | Primary brand colour — CTAs, highlights, glow |
| `--color-accent-2` | `#00D4FF` | rgb(0,212,255) | Secondary accent — gradient endpoints |
| `--color-text` | `#F9FAFB` | rgb(249,250,251) | Primary body text on dark backgrounds |
| `--color-text-muted` | `#9CA3AF` | rgb(156,163,175) | Secondary/supporting text, placeholders |
| `--color-border` | `#374151` | rgb(55,65,81) | Subtle card borders and dividers |
| `--color-success` | `#10B981` | rgb(16,185,129) | Success states, form submission confirmation |
| `--color-error` | `#EF4444` | rgb(239,68,68) | Validation errors, warning states |

### 6.3 Typography

| Role | Font Family | Weight | Size / Notes |
|---|---|---|---|
| Display / Hero | Plus Jakarta Sans | 700–800 | `clamp(48px, 8vw, 96px)` — fluid responsive |
| Page Headings H1 | Plus Jakarta Sans | 700 | `clamp(36px, 5vw, 56px)` — fluid responsive |
| Section Headings H2 | Plus Jakarta Sans | 600 | 32–40px |
| Sub-headings H3–H4 | Inter | 600 | 20–28px |
| Body Text | Inter | 400 | 16px (1rem), line-height 1.7 |
| UI Labels / Badges | Inter | 500 | 12–13px, uppercase, letter-spacing 0.05em |
| Code Blocks | JetBrains Mono | 400 | 14px, syntax-highlighted via highlight.js |

> All heading sizes use CSS `clamp()` for fluid typography scaling between breakpoints. Fonts are loaded from Google Fonts via `preconnect` and `font-display: swap`.

### 6.4 Spacing and Grid System

The layout uses an **8px base spacing unit**. All padding, margin, and gap values are multiples of 8px (8, 16, 24, 32, 48, 64, 96, 128px). The grid is a 12-column CSS Grid with a max-width container of `1280px`, centred with auto horizontal margins, and inner padding of 24px (mobile) to 80px (desktop). Responsive breakpoints: `xs` (< 480px), `sm` (480px), `md` (768px), `lg` (1024px), `xl` (1280px).

### 6.5 Animation Specifications

#### 6.5.1 Hero Animations

The hero canvas renders a Three.js `PointCloud` field of connected particles in accent colours, continuously drifting. A `mousemove` event triggers subtle field distortion using GSAP `quickTo` for 60fps performance. The headline text is split by character using GSAP `SplitText`; characters animate from `{opacity:0, y:80, rotateX:90deg}` to `{opacity:1, y:0, rotateX:0}` with a stagger of `0.025s` per character, `ease: "power4.out"`, and a total duration of `0.8s`. CTA buttons slide up with `scale: 0.9 → 1.0` and `opacity: 0 → 1`, delayed `0.6s` after the headline completes, using `ease: "back.out(1.7)"`.

#### 6.5.2 Scroll-Triggered Animation Rules (Global)

All scroll animations follow these rules to ensure a cohesive feel across the site. Section headings animate from `{opacity:0, y:40}` to `{opacity:1, y:0}`, duration `0.8s`, `ease: "power2.out"`, triggered at `"top 85%"`. Cards stagger from `{opacity:0, y:60, scale:0.95}` to `{opacity:1, y:0, scale:1}` with a `0.12s` stagger per card, using GSAP `BatchManager` for performance. Horizontal decorative lines scale from `scaleX:0` to `scaleX:1` with `transform-origin:left`, duration `1.2s`. Image reveal uses a CSS `clipPath` animation from `"inset(0 100% 0 0)"` to `"inset(0 0% 0 0)"` paired with a simultaneous `scale: 1.1 → 1` on the inner image. Stats counters use GSAP CountTo on ScrollTrigger `"onEnter"`, duration `2s`, `ease: "power1.out"`, with `once:true` so they don't re-trigger on scroll-up.

#### 6.5.3 Hover Micro-interactions

Project cards implement a 3D tilt effect via vanilla-tilt.js (`maxTilt:8`, `speed:400`, `glare:true`, `maxGlare:0.1`). The thumbnail scales from `1 → 1.08` with a `0.4s ease` CSS transition, the category badge shifts up 4px, and a purple border glow appears via `box-shadow: 0 0 24px rgba(108,99,255,0.5)`. Service cards trigger a glassmorphism shimmer — a diagonal gradient sweep on the `::before` pseudo-element using a CSS `@keyframes shimmer`, 600ms duration. Navigation links animate a custom `::after` underline from `scaleX:0 → 1`, transform-origin centre, 300ms ease. Primary CTA buttons exhibit a magnetic effect — a `mousemove` listener translates the button by 15% of the cursor's offset from the button centre, resetting on `mouseleave` with GSAP `elastic.out(1.5, 0.5)`. Team member cards flip using CSS `rotateY: 0 → 180deg` (front) and `rotateY: 180 → 360deg` (back) with `backface-visibility:hidden` and a `0.6s cubic-bezier` transition.

#### 6.5.4 Page Transition Animation

When a navigation link is clicked, a GSAP-powered curtain (a full-viewport dark overlay) slides up from the bottom over 300ms. The URL change occurs after the curtain covers the screen. On the new page, the curtain then slides out upwards as the content fades in with a staggered entrance. The total round-trip duration is approximately 700ms, giving a cinematic feel without sacrificing perceived performance. This is implemented via a Blade layout partial with an Alpine.js `x-data` transition controller that intercepts anchor clicks using a `data-transition` attribute.

#### 6.5.5 Custom Cursor (Desktop Only)

A dual-layer cursor consists of a 10px accent-coloured filled circle that follows the pointer exactly (no lag), and a 40px hollow ring that follows using GSAP `quickTo` with a lerp factor of `0.10`, creating an organic trailing lag effect. On hover over interactive elements (links, buttons, cards), the ring expands to 70px, its fill colour inverts to the accent, and the inner dot hides. On hover over images, the ring displays a "View" text label. The entire custom cursor is hidden on touch devices using `@media (pointer: coarse)`, restoring native cursor behaviour.

### 6.6 Navigation Design

**`[UI-001]`** The main navigation MUST be a sticky top bar with glassmorphism background: `backdrop-filter: blur(20px)`, `background: rgba(13,13,13,0.7)`, transitioning to `rgba(13,13,13,0.95)` after 80px of scroll, managed via Alpine.js scroll listener.

**`[UI-002]`** Desktop navigation layout: Somaticx logo (left, with subtle hover glow animation), navigation links (Home, About, Services, Portfolio, Contact) centred, and a "Hire Us" gradient-border CTA button on the right.

**`[UI-003]`** Mobile navigation: links collapse behind a hamburger icon (3-bar animated to × on open). The mobile menu MUST be a full-screen overlay with staggered link animations — each link slides in from the left 80px with GSAP, staggered 0.08s apart.

**`[UI-004]`** The current active page MUST be indicated by a glowing underline or dot in the accent colour, detected via Laravel's `Request::routeIs()` helper passed to the Blade component.

### 6.7 Responsive Design Matrix

| Breakpoint | Viewport Range | Key Layout Behaviours |
|---|---|---|
| xs — Mobile | < 480px | Single column, 16px h-padding, hamburger nav, hero text ~36px, reduced particle count, animations simplified |
| sm — Mobile+ | 480–767px | Single column, slightly larger text, 2-col for simple icon lists or tech badges |
| md — Tablet | 768–1023px | Compact horizontal nav or hamburger, 2-col project grid, services 2-col, hero text ~48px |
| lg — Desktop | 1024–1279px | Full horizontal nav, 3-col project grid, split layouts, all animations active, custom cursor active |
| xl — Wide | ≥ 1280px | Max-width container centred at 1280px, 4-col project grid optional, hero text up to 96px |

---

## 7. Non-Functional Requirements

### 7.1 Performance Requirements

| Requirement ID | Metric | Target |
|---|---|---|
| NFR-001 | Lighthouse Performance Score | ≥ 90 on desktop  /  ≥ 75 on mobile |
| NFR-002 | Largest Contentful Paint (LCP) | ≤ 2.5 seconds on simulated 4G |
| NFR-003 | Cumulative Layout Shift (CLS) | ≤ 0.10 across all public pages |
| NFR-004 | Time to First Byte (TTFB) | ≤ 600ms via Laravel config/route/view caching |
| NFR-005 | First Contentful Paint (FCP) | ≤ 1.5 seconds |
| NFR-006 | Initial JS payload | ≤ 150KB gzipped — GSAP and Three.js loaded async/defer |
| NFR-007 | CSS payload | ≤ 30KB gzipped — Tailwind v4 JIT purges unused utilities at build |
| NFR-008 | Image formats | All images served as WebP with JPEG fallback via `<picture>` element |

All images MUST have explicit `width` and `height` attributes to prevent layout shift. Lazy loading (`loading="lazy"`) MUST be applied to all below-the-fold images.

### 7.2 Security Requirements

**`[SEC-001]`** All HTTP responses MUST include security headers: `Content-Security-Policy` (configured to permit self and CDN sources), `X-Frame-Options: DENY`, `X-Content-Type-Options: nosniff`, `Referrer-Policy: strict-origin-when-cross-origin`, `Permissions-Policy`.

**`[SEC-002]`** SQL injection is prevented exclusively via Laravel Eloquent ORM and parameterised query bindings. Raw `DB::statement()` calls on user input are strictly prohibited.

**`[SEC-003]`** CSRF protection MUST be active on all POST/PUT/DELETE routes using Laravel's `@csrf` Blade directive. AJAX form submission MUST include the `X-CSRF-TOKEN` header.

**`[SEC-004]`** Admin routes MUST be protected by Laravel's `auth` middleware. Session regeneration (`Session::regenerate()`) MUST occur on login and logout.

**`[SEC-005]`** Rate limiting: contact form endpoint — **3 requests per IP per 60 minutes**. Admin login — **5 failed attempts per IP per 10 minutes**. Implemented via Laravel `RateLimiter` in `RouteServiceProvider`.

**`[SEC-006]`** File uploads MUST validate MIME type server-side, enforce a 5MB size limit, and store files outside the public web root via Laravel Storage, served through signed URL routes.

**`[SEC-007]`** All user-supplied content displayed in Blade templates MUST use the `{{ }}` double-brace escaping syntax. The `{!! !!}` unescaped output is only permitted for trusted admin-controlled Markdown (sanitised via HTMLPurifier).

**`[SEC-008]`** The `.env` file MUST NOT be committed to version control. A `.env.example` with placeholder values MUST be committed instead.

### 7.3 SEO Requirements

**`[NFR-009]`** Every public page MUST have a unique, database-populated `<title>` tag and `<meta name="description">` rendered via a `SeoService` class and an `<x-seo>` Blade component.

**`[NFR-010]`** Canonical URL tags MUST be present on every public page to prevent duplicate content from URL parameter variations.

**`[NFR-011]`** Open Graph tags (`og:title`, `og:description`, `og:image`, `og:url`, `og:type`) and Twitter Card meta tags MUST be present on all pages, with project-specific `og:image` on portfolio detail pages.

**`[NFR-012]`** JSON-LD structured data MUST be implemented: `Organization` schema on all pages, `WebSite` schema on homepage, `Service` schema on service pages, `CreativeWork` schema on portfolio detail pages.

**`[NFR-013]`** An XML sitemap MUST be auto-generated at `/sitemap.xml` and updated when projects or services are published, including `<lastmod>`, `<changefreq>`, and `<priority>` values.

**`[NFR-014]`** A `robots.txt` MUST allow all crawlers on public routes and explicitly `Disallow: /admin/`.

**`[NFR-015]`** All public URLs MUST use lowercase hyphen-separated slugs. Pagination MUST use `rel="prev"` and `rel="next"` link elements.

### 7.4 Accessibility Requirements

**`[NFR-016]`** All interactive elements MUST have visible focus indicators with a minimum 3:1 contrast against the background. Default browser focus outlines MUST NOT be removed without a styled replacement.

**`[NFR-017]`** Text contrast ratios MUST comply with WCAG 2.1 AA: minimum **4.5:1** for normal text, **3:1** for large text.

**`[NFR-018]`** All meaningful images MUST have descriptive `alt` attributes. Decorative images MUST have `alt=""` so screen readers skip them.

**`[NFR-019]`** The site MUST be fully keyboard navigable in a logical tab order. Focus MUST be trapped within modal dialogs and the mobile menu overlay.

**`[NFR-020]`** All GSAP animations and Three.js canvas MUST be disabled or instantly completed when `prefers-reduced-motion: reduce` is detected, using a CSS media query check at the top of `app.js`.

**`[NFR-021]`** ARIA attributes MUST be applied to: hamburger toggle (`aria-expanded`, `aria-controls`), mobile menu (`role="navigation"`, `aria-label`), form error messages (`role="alert"`), icon-only buttons (`aria-label`), and carousels (`role="region"`, `aria-live`).

### 7.5 Maintainability Requirements

**`[NFR-022]`** PHP code MUST comply with PSR-12 coding standard, enforced by Laravel Pint in CI.

**`[NFR-023]`** Controllers MUST remain thin — no business logic inside controllers. All logic lives in Service classes. Blade components receive only the props they need; no DB queries inside Blade views.

**`[NFR-024]`** Eager loading (Eloquent `with()` method) MUST be used on all queries with relationships to prevent N+1 query problems.

**`[NFR-025]`** All Eloquent models MUST have PHPDoc `@property` annotations. All Service classes MUST have method DocBlock comments.

**`[NFR-026]`** A `DatabaseSeeder` with realistic demo data MUST bootstrap a complete development environment via a single `php artisan migrate:fresh --seed` command.

---

## 8. Technology Stack

### 8.1 Backend Technologies

| Technology | Version | Purpose and Notes |
|---|---|---|
| PHP | 8.2+ | Server-side runtime — required by Laravel 11 |
| Laravel Framework | 11.x | MVC framework, Eloquent ORM, queues, mail, routing, auth |
| MySQL | 8.0+ | Primary relational database — UTF8MB4 charset |
| Redis | 7.x | Session, cache, and queue driver in production |
| Nginx + PHP-FPM | Latest | Production web server stack. Nginx as reverse proxy. |
| Spatie Media Library | Latest | Advanced file upload with automatic WebP image conversions |
| Spatie Laravel SEO | Latest | SEO meta tag management via fluent PHP API |
| Spatie Sitemap | Latest | Auto-generated XML sitemap from route definitions |
| Laravel Debugbar | Dev only | Query analysis and performance profiling in development |
| Pest PHP | v2.x | Elegant PHP testing framework for unit + feature tests |
| Laravel Pint | Bundled | Official PHP code style fixer (PSR-12 enforcement) |

### 8.2 Frontend Technologies

| Technology | Version | Purpose and Notes |
|---|---|---|
| Laravel Blade | Laravel 11 | Templating engine — components, slots, `@directives`, `x-*` syntax |
| Alpine.js | v3.x | Reactive UI state: dropdowns, overlays, carousels, form validation |
| Tailwind CSS | v4.x | Utility-first CSS — pre-configured per project constraints |
| GSAP (GreenSock) | 3.12+ | Core animation engine for all scroll-triggered and interaction animations |
| GSAP ScrollTrigger | Plugin | Viewport-based animation triggers with scrub, pin, batch support |
| GSAP SplitText | Plugin | Character-level text splitting for headline animations |
| Three.js | r160+ | WebGL engine for hero particle mesh / interactive 3D canvas background |
| Swiper.js | v11 | Touch-enabled carousel for testimonials and project galleries |
| GLightbox | v3 | Accessible, animated lightbox for project gallery images |
| Vanilla-tilt.js | Latest | 3D card tilt hover effect for project and service cards |
| Lottie Web | Latest | JSON-based animation playback for success states and illustrations |
| highlight.js | Latest | Syntax highlighting for code snippets in project descriptions |
| Vite | Latest | Asset bundler via Laravel Vite Plugin with HMR in development |

---

## 9. Blade Component Architecture

### 9.1 Layout Components

Every public page extends `resources/views/layouts/app.blade.php`, the root layout that provides the HTML shell, loads fonts/CSS/JS via the `@vite` directive, renders the custom cursor overlay, the page transition curtain div, the `<x-nav />` global navigation, and the `<x-footer />` global footer. The admin panel has a separate `resources/views/layouts/admin.blade.php` with a left sidebar, top bar, and main content area.

### 9.2 Public Blade Component Reference

| Component Tag | Description and Key Props |
|---|---|
| `<x-nav />` | Sticky glassmorphism navigation. Detects active route via `Request::routeIs()`. Manages mobile overlay via Alpine.js `x-data`. |
| `<x-hero :title :subtitle :ctas />` | Full-viewport animated hero with Three.js canvas slot, animated headline, sub-headline, and CTA buttons. |
| `<x-project-card :project />` | Portfolio project card. Renders thumbnail, overlay CTA, category badge, title. Initialises vanilla-tilt on mount via `x-init`. |
| `<x-service-card :service />` | Glassmorphism service card with icon, title, tagline, description excerpt, and "Learn More" CTA. |
| `<x-testimonial-card :t />` | Testimonial slide with star rating SVGs, client photo (or initials avatar), name, company, and quote text. |
| `<x-team-card :member />` | CSS 3D flip card. Front: photo, name, role. Back: bio excerpt and social links. |
| `<x-stat-counter :value :label :prefix :suffix />` | Animated counter with `data-target` attribute; Alpine.js `x-intersect` triggers GSAP CountTo. |
| `<x-section-heading :title :subtitle :align />` | Standardised section heading block with animated gradient underline, centred or left-aligned. |
| `<x-tech-badge :name :icon />` | Technology pill badge used in project cards and detail pages. |
| `<x-contact-form />` | Full Alpine.js reactive contact form with real-time validation, CSRF token, AJAX submission, and success state. |
| `<x-gallery :images />` | GLightbox-powered image gallery grid with thumbnail hover zoom and lightbox on click. |
| `<x-breadcrumb :crumbs />` | Accessible breadcrumb with JSON-LD `BreadcrumbList` schema. Props: array of `[label, url]` pairs. |
| `<x-seo :title :description :image :type />` | Injects all SEO tags (title, meta description, OG, Twitter Card, canonical, JSON-LD) into `<head>`. |
| `<x-page-loader />` | Full-screen loading overlay that fades out after `DOMContentLoaded` fires (prevents FOUC on heavy pages). |
| `<x-footer />` | Global footer with logo, navigation columns, social media icon links, newsletter field, and copyright. |

---

## 10. Testing Requirements

### 10.1 Unit Tests

**`[TEST-001]`** All Service class methods (`ContactService`, `ProjectService`, `SeoService`) MUST have unit tests covering success paths, validation failures, and edge cases. Target: ≥ 80% code coverage on service classes.

**`[TEST-002]`** Eloquent model scopes (`Project::published()`, `Project::featured()`, `Project::byCategory()`) MUST have unit tests verifying correct SQL scoping behaviour using an in-memory SQLite database.

### 10.2 Feature / Integration Tests

**`[TEST-003]`** All public routes MUST have feature tests verifying: HTTP 200 for existing routes, HTTP 404 for missing slugs, correct view rendered, and correct data present in the view.

**`[TEST-004]`** Contact form submission MUST have tests for: successful submit (201, record in DB, mail dispatched via `Mail::fake()`), validation failure (422, error structure), and rate limit (429 after threshold exceeded).

**`[TEST-005]`** Admin CRUD for Projects MUST have feature tests: create (auth required, record created, thumbnail stored), read (pagination, filter, search), update (record updated), delete (soft deleted, recoverable from trash), and unauthenticated access (302 redirect to login).

### 10.3 Browser Compatibility

The website MUST function without visual defects or JavaScript console errors on: Google Chrome 120+, Mozilla Firefox 120+, Safari 16+ (macOS and iOS 16+), Microsoft Edge 120+, and Samsung Internet 23+. Testing MUST be performed on physical or emulated devices at each defined responsive breakpoint. The Three.js canvas MUST gracefully degrade (hide canvas, show fallback gradient) on browsers without WebGL support.

---

## 11. Deployment & Infrastructure

### 11.1 Environment Strategy

| Environment | Configuration | Purpose |
|---|---|---|
| Development | `APP_ENV=local`, `APP_DEBUG=true`, Debugbar enabled | Local development with HMR and real-time error display |
| Staging | `APP_ENV=staging`, `APP_DEBUG=false`, MySQL, Redis, CDN | Client review and QA — mirrors production configuration |
| Production | `APP_ENV=production`, all caches active, queue workers, CDN, Redis | Live public website with full performance optimisation |

### 11.2 Production Launch Checklist

```bash
php artisan config:cache    # Cache all config files into a single file
php artisan route:cache     # Serialise all route definitions
php artisan view:cache      # Pre-compile all Blade templates
php artisan event:cache     # Cache event-listener mappings
npm run build               # Compile & fingerprint all frontend assets via Vite
```

Beyond these commands, the production environment also requires: Supervisor configured for persistent `php artisan queue:work --daemon` workers; Nginx configured with gzip/brotli compression and HTTP/2; SSL/TLS via Let's Encrypt with auto-renewal; daily backups via `spatie/laravel-backup` to offsite S3-compatible storage; PHP OPcache enabled with `memory_limit=256MB`; `robots.txt` correctly blocking `/admin/`; and Google Search Console sitemap submitted.

### 11.3 Version Control Workflow

Git with GitHub or GitLab. Branch strategy: `main` (production-stable), `develop` (integration branch), `feature/*` (individual feature branches). All merges to `main` require a pull request with at least one peer review approval and a passing CI pipeline (Pest test suite + Pint style check). Semantic versioning (`MAJOR.MINOR.PATCH`) is applied for releases.

---

## 12. Implementation Roadmap

| # | Phase | Deliverables | Duration | Priority |
|---|---|---|---|---|
| 1 | Foundation | Laravel project, DB migrations, models, seeders, Vite config, auth setup | 1 week | Critical |
| 2 | Backend Core | All controllers, services, form requests, routes, admin CRUD operations | 1.5 weeks | Critical |
| 3 | Layout & Base UI | `app.blade.php`, `x-nav`, `x-footer`, base Tailwind styles, typography system | 1 week | Critical |
| 4 | Homepage | Hero (Three.js), marquee, services, portfolio, stats, testimonials sections | 1.5 weeks | High |
| 5 | Inner Pages | About, Services (index + detail), Portfolio (index + detail), Contact | 1.5 weeks | High |
| 6 | Animations | GSAP full integration, ScrollTrigger, hover FX, page transitions, cursor | 1 week | High |
| 7 | Admin Dashboard | Dashboard UI, all CRUD modules, image upload, inquiry viewer, settings | 1 week | High |
| 8 | SEO & Performance | Meta tags, sitemap, JSON-LD, WebP images, cache, Lighthouse optimisation | 0.5 week | Medium |
| 9 | QA & Testing | Pest test suite, cross-browser QA, accessibility audit, bug fixes | 1 week | Medium |
| 10 | Production Launch | Server setup, DNS, SSL, CDN, deployment, monitoring, handover | 0.5 week | Critical |

> **Total estimated timeline:** approximately 10–11 weeks for 1 full-stack developer + 1 UI designer working in parallel. Compresses to ~6–7 weeks with 2 developers.

---

## 13. Appendix

### A. Artisan Command Reference

| Command | Description |
|---|---|
| `php artisan migrate:fresh --seed` | Drop all tables, re-run migrations, seed demo data |
| `php artisan make:model Project -mcs` | Create Model, Migration, Controller, Seeder in one command |
| `php artisan make:request StoreContactRequest` | Generate a typed FormRequest validation class |
| `php artisan cache:clear` | Clear application, config, route, and view caches |
| `php artisan queue:work --daemon` | Start persistent queue worker for email dispatch |
| `php artisan sitemap:generate` | Manually regenerate the XML sitemap file |
| `php artisan pint` | Auto-fix all PHP code to PSR-12 standard |
| `./vendor/bin/pest --coverage` | Run full test suite with code coverage report |
| `npm run dev` | Start Vite dev server with Alpine.js and GSAP HMR |
| `npm run build` | Production asset build: minified and fingerprinted |

### B. Demo Seeder Data Plan

The `DatabaseSeeder` MUST populate the following realistic content: **3 categories** (Website Development, App Development, Website Maintenance); **12 projects** — 6 web, 4 app, 2 maintenance, with 6 marked as featured; **2 fully detailed service records**; **4 active team members** with realistic bios; **6 testimonials** with 5-star ratings, 4 marked as featured; **8 company stats** (e.g., Projects Delivered: 120+, Happy Clients: 85, Years of Experience: 5, Uptime Guarantee: 99.9%); **15 skills** across Frontend, Backend, and Mobile categories; and **1 admin user** (`admin@somaticx.com` / password changeable via `.env`).

### C. Requirement Traceability Matrix

| Req. ID | Description | Design Section | Test Case ID | Status |
|---|---|---|---|---|
| FR-001 | Animated Hero Section | 6.5.1 | TEST-Hero-001 | Planned |
| FR-007 | Testimonials Carousel | 5.1.6 | TEST-Home-002 | Planned |
| FR-017 | Portfolio Category Filter | 5.4 | TEST-Port-001 | Planned |
| FR-025 | Contact Form Rate Limiting | 7.2 | TEST-Con-003 | Planned |
| FR-028 | Projects CRUD with Soft Delete | 5.6 | TEST-Adm-003 | Planned |
| NFR-001 | Lighthouse Score ≥ 90 | 7.1 | TEST-Perf-001 | Planned |
| NFR-011 | Open Graph Meta Tags | 7.3 | TEST-SEO-002 | Planned |
| SEC-001 | HTTP Security Headers | 7.2 | TEST-Sec-001 | Planned |
| NFR-020 | Reduced Motion Compliance | 6.5 | TEST-A11y-001 | Planned |

---

*Somaticx Portfolio Website — SRS v1.0.0 — February 2026*

**CONFIDENTIAL — Internal Use Only**
