# STEP 1: Foundation & Backend Architecture
## SomaTech Portfolio Website Implementation

> **SRS Reference:** Sections 3, 4, 7.2, 8.1 | **Priority:** Critical | **Duration:** 1 week

---

## Overview

This step establishes the complete backend foundation including database schema, Eloquent models, service layer, authentication, and API endpoints. All implementations follow Laravel 12 conventions and SRS specifications.

---

## 1.1 Database Migrations

### SRS Reference: Section 4 (Database Design)

#### Migration 1: Categories Table
**File:** `database/migrations/2024_02_17_000001_create_categories_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 100)->unique();
            $table->string('icon')->nullable();
            $table->timestamps();
            
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
```

#### Migration 2: Services Table
**File:** `database/migrations/2024_02_17_000002_create_services_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline', 300)->nullable();
            $table->longText('description');
            $table->string('icon')->nullable();
            $table->json('features')->nullable();
            $table->json('technologies')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['is_featured', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
```

#### Migration 3: Projects Table
**File:** `database/migrations/2024_02_17_000003_create_projects_table.php`
**SRS Reference:** Section 4.2

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('short_description', 500);
            $table->longText('description');
            $table->string('client_name')->nullable();
            $table->json('tech_stack')->nullable();
            $table->string('project_url', 500)->nullable();
            $table->string('github_url', 500)->nullable();
            $table->string('thumbnail', 500);
            $table->json('gallery')->nullable();
            $table->enum('status', ['draft', 'published', 'featured'])->default('draft');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('slug');
            $table->index('category_id');
            $table->index('status');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
```

#### Migration 4: Team Members Table
**File:** `database/migrations/2024_02_17_000004_create_team_members_table.php`
**SRS Reference:** Section 4.5

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->text('bio')->nullable();
            $table->string('photo', 500)->nullable();
            $table->string('linkedin_url', 500)->nullable();
            $table->string('github_url', 500)->nullable();
            $table->json('skills')->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['is_active', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
```

#### Migration 5: Testimonials Table
**File:** `database/migrations/2024_02_17_000005_create_testimonials_table.php`
**SRS Reference:** Section 4.6

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_company')->nullable();
            $table->string('client_role')->nullable();
            $table->string('client_photo', 500)->nullable();
            $table->text('content');
            $table->tinyInteger('rating')->unsigned()->default(5);
            $table->foreignId('project_id')->nullable()->constrained()->nullOnDelete();
            $table->boolean('is_featured')->default(false);
            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['is_featured', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
```

#### Migration 6: Contact Inquiries Table
**File:** `database/migrations/2024_02_17_000006_create_contact_inquiries_table.php`
**SRS Reference:** Section 4.7

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30)->nullable();
            $table->string('company')->nullable();
            $table->string('service_interest', 100)->nullable();
            $table->string('budget_range', 100)->nullable();
            $table->text('message');
            $table->string('ip_address', 45)->nullable();
            $table->enum('status', ['new', 'read', 'replied', 'archived'])->default('new');
            $table->timestamp('read_at')->nullable();
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
    }
};
```

#### Migration 7: Skills Table
**File:** `database/migrations/2024_02_17_000007_create_skills_table.php`
**SRS Reference:** Section 4.8

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('category', 100)->nullable();
            $table->tinyInteger('proficiency')->unsigned()->default(100);
            $table->string('icon')->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['category', 'sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
```

#### Migration 8: Stats Table
**File:** `database/migrations/2024_02_17_000008_create_stats_table.php`
**SRS Reference:** Section 4.9

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->unsignedInteger('value');
            $table->string('prefix', 20)->nullable();
            $table->string('suffix', 20)->nullable();
            $table->string('icon')->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();
            
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
```

#### Migration 9: Site Settings Table
**File:** `database/migrations/2024_02_17_000009_create_site_settings_table.php`
**SRS Reference:** Section 4.10

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->longText('value')->nullable();
            $table->string('group', 100)->default('general');
            $table->enum('type', ['text', 'textarea', 'image', 'boolean', 'json'])->default('text');
            $table->timestamps();
            
            $table->index('group');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
```

---

## 1.2 Eloquent Models

### SRS Reference: Section 3.1, NFR-024 (Eager Loading), NFR-025 (PHPDoc)

#### Model 1: Category
**File:** `app/Models/Category.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string|null $icon
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'icon',
    ];

    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
```

#### Model 2: Service
**File:** `app/Models/Service.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $tagline
 * @property string $description
 * @property string|null $icon
 * @property array|null $features
 * @property array|null $technologies
 * @property bool $is_featured
 * @property int $sort_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'description',
        'icon',
        'features',
        'technologies',
        'is_featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'features' => 'array',
            'technologies' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->orderBy('sort_order');
    }
}
```

#### Model 3: Project
**File:** `app/Models/Project.php`
**SRS Reference:** Section 4.2, FR-028 (Soft Deletes)

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $category_id
 * @property string $short_description
 * @property string $description
 * @property string|null $client_name
 * @property array|null $tech_stack
 * @property string|null $project_url
 * @property string|null $github_url
 * @property string $thumbnail
 * @property array|null $gallery
 * @property string $status
 * @property \Carbon\Carbon|null $start_date
 * @property \Carbon\Carbon|null $end_date
 * @property int $sort_order
 * @property string|null $meta_title
 * @property string|null $meta_description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 */
class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'short_description',
        'description',
        'client_name',
        'tech_stack',
        'project_url',
        'github_url',
        'thumbnail',
        'gallery',
        'status',
        'start_date',
        'end_date',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'tech_stack' => 'array',
            'gallery' => 'array',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }

    public function scopePublished($query)
    {
        return $query->whereIn('status', ['published', 'featured']);
    }

    public function scopeFeatured($query)
    {
        return $query->where('status', 'featured')->orderBy('sort_order');
    }

    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function getMetaTitleAttribute($value): string
    {
        return $value ?? $this->title;
    }

    public function getMetaDescriptionAttribute($value): string
    {
        return $value ?? $this->short_description;
    }
}
```

#### Model 4: TeamMember
**File:** `app/Models/TeamMember.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $role
 * @property string|null $bio
 * @property string|null $photo
 * @property string|null $linkedin_url
 * @property string|null $github_url
 * @property array|null $skills
 * @property int $sort_order
 * @property bool $is_active
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'bio',
        'photo',
        'linkedin_url',
        'github_url',
        'skills',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'skills' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getInitialsAttribute(): string
    {
        $names = explode(' ', $this->name);
        $initials = '';
        
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1));
        }
        
        return substr($initials, 0, 2);
    }
}
```

#### Model 5: Testimonial
**File:** `app/Models/Testimonial.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $client_name
 * @property string|null $client_company
 * @property string|null $client_role
 * @property string|null $client_photo
 * @property string $content
 * @property int $rating
 * @property int|null $project_id
 * @property bool $is_featured
 * @property int $sort_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_company',
        'client_role',
        'client_photo',
        'content',
        'rating',
        'project_id',
        'is_featured',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'rating' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->orderBy('sort_order');
    }

    public function getClientInitialsAttribute(): string
    {
        $names = explode(' ', $this->client_name);
        $initials = '';
        
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1));
        }
        
        return substr($initials, 0, 2);
    }
}
```

#### Model 6: ContactInquiry
**File:** `app/Models/ContactInquiry.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $company
 * @property string|null $service_interest
 * @property string|null $budget_range
 * @property string $message
 * @property string|null $ip_address
 * @property string $status
 * @property \Carbon\Carbon|null $read_at
 * @property \Carbon\Carbon|null $replied_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ContactInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'service_interest',
        'budget_range',
        'message',
        'ip_address',
        'status',
        'read_at',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    public function scopeUnread($query)
    {
        return $query->where('status', 'new');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function markAsRead(): void
    {
        if ($this->status === 'new') {
            $this->update([
                'status' => 'read',
                'read_at' => now(),
            ]);
        }
    }
}
```

#### Model 7: Skill
**File:** `app/Models/Skill.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string|null $category
 * @property int $proficiency
 * @property string|null $icon
 * @property int $sort_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'proficiency',
        'icon',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'proficiency' => 'integer',
        ];
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category)->orderBy('sort_order');
    }
}
```

#### Model 8: Stat
**File:** `app/Models/Stat.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $label
 * @property int $value
 * @property string|null $prefix
 * @property string|null $suffix
 * @property string|null $icon
 * @property int $sort_order
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Stat extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'value',
        'prefix',
        'suffix',
        'icon',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'integer',
        ];
    }

    public function getFormattedValueAttribute(): string
    {
        return ($this->prefix ?? '') . $this->value . ($this->suffix ?? '');
    }
}
```

#### Model 9: SiteSetting
**File:** `app/Models/SiteSetting.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property string $group
 * @property string $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'type',
    ];

    protected static function booted(): void
    {
        static::saved(function () {
            Cache::forget('site_settings');
        });

        static::deleted(function () {
            Cache::forget('site_settings');
        });
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        $settings = Cache::rememberForever('site_settings', function () {
            return static::all()->pluck('value', 'key');
        });

        return $settings->get($key, $default);
    }

    public static function set(string $key, mixed $value, string $group = 'general', string $type = 'text'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'group' => $group,
                'type' => $type,
            ]
        );
    }
}
```

---

## 1.3 Service Layer Classes

### SRS Reference: Section 3.1, NFR-023 (Thin Controllers)

#### Service 1: ProjectService
**File:** `app/Services/ProjectService.php`

```php
<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    /**
     * Get all published projects with eager loading
     */
    public function getAllPublished(?int $categoryId = null, int $perPage = 12): LengthAwarePaginator
    {
        return Project::with('category')
            ->published()
            ->when($categoryId, fn($query) => $query->byCategory($categoryId))
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get featured projects for homepage
     * SRS Reference: FR-005
     */
    public function getFeatured(int $limit = 6): Collection
    {
        return Project::with('category')
            ->featured()
            ->limit($limit)
            ->get();
    }

    /**
     * Get project by slug with relationships
     */
    public function getBySlug(string $slug): ?Project
    {
        return Project::with(['category', 'testimonials'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Get previous and next projects for navigation
     * SRS Reference: FR-020
     */
    public function getAdjacentProjects(Project $project): array
    {
        $previous = Project::published()
            ->where('sort_order', '<', $project->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        $next = Project::published()
            ->where('sort_order', '>', $project->sort_order)
            ->orderBy('sort_order')
            ->first();

        return [
            'previous' => $previous,
            'next' => $next,
        ];
    }

    /**
     * Get projects count for admin dashboard
     * SRS Reference: FR-027
     */
    public function getTotalCount(): int
    {
        return Project::count();
    }
}
```

#### Service 2: ContactService
**File:** `app/Services/ContactService.php`
**SRS Reference:** FR-025

```php
<?php

namespace App\Services;

use App\Mail\AdminNotificationMail;
use App\Mail\ContactConfirmationMail;
use App\Models\ContactInquiry;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    /**
     * Store contact inquiry and dispatch notifications
     * SRS Reference: FR-025
     */
    public function storeInquiry(array $data): ContactInquiry
    {
        $inquiry = ContactInquiry::create([
            ...$data,
            'ip_address' => request()->ip(),
            'status' => 'new',
        ]);

        // Dispatch queued email to admin
        Mail::to(config('mail.admin_email'))
            ->queue(new AdminNotificationMail($inquiry));

        // Send confirmation to client
        Mail::to($inquiry->email)
            ->queue(new ContactConfirmationMail($inquiry));

        return $inquiry;
    }

    /**
     * Get unread inquiries count
     * SRS Reference: FR-027
     */
    public function getUnreadCount(): int
    {
        return ContactInquiry::unread()->count();
    }

    /**
     * Get recent inquiries for chart
     * SRS Reference: FR-027
     */
    public function getInquiriesLast30Days(): array
    {
        $inquiries = ContactInquiry::where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $inquiries->pluck('count', 'date')->toArray();
    }
}
```

#### Service 3: SeoService
**File:** `app/Services/SeoService.php`
**SRS Reference:** Section 7.3 (SEO Requirements)

```php
<?php

namespace App\Services;

use Illuminate\Support\Facades\URL;

class SeoService
{
    /**
     * Generate SEO meta tags
     * SRS Reference: NFR-009, NFR-010, NFR-011
     */
    public function generateMeta(array $data): array
    {
        $defaults = [
            'title' => config('app.name') . ' - Premium Web & App Development',
            'description' => 'SomaTech specializes in Website Development, App Development, and Website Maintenance. Transforming ideas into digital excellence.',
            'image' => URL::to('/images/og-default.jpg'),
            'url' => URL::current(),
            'type' => 'website',
        ];

        $meta = array_merge($defaults, $data);

        return [
            'title' => $meta['title'],
            'description' => $meta['description'],
            'canonical' => $meta['url'],
            'og' => [
                'title' => $meta['title'],
                'description' => $meta['description'],
                'image' => $meta['image'],
                'url' => $meta['url'],
                'type' => $meta['type'],
            ],
            'twitter' => [
                'card' => 'summary_large_image',
                'title' => $meta['title'],
                'description' => $meta['description'],
                'image' => $meta['image'],
            ],
        ];
    }

    /**
     * Generate JSON-LD schema
     * SRS Reference: NFR-012
     */
    public function generateSchema(string $type, array $data): string
    {
        $schema = match ($type) {
            'Organization' => $this->organizationSchema(),
            'WebSite' => $this->websiteSchema(),
            'Service' => $this->serviceSchema($data),
            'CreativeWork' => $this->creativeWorkSchema($data),
            default => null,
        };

        return $schema ? json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) : '';
    }

    private function organizationSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'SomaTech',
            'url' => URL::to('/'),
            'logo' => URL::to('/images/logo.png'),
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+1-555-SOMATECH',
                'contactType' => 'Customer Service',
            ],
            'sameAs' => [
                'https://github.com/somatech',
                'https://linkedin.com/company/somatech',
            ],
        ];
    }

    private function websiteSchema(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'SomaTech',
            'url' => URL::to('/'),
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => URL::to('/portfolio?search={search_term_string}'),
                'query-input' => 'required name=search_term_string',
            ],
        ];
    }

    private function serviceSchema(array $data): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
            'provider' => [
                '@type' => 'Organization',
                'name' => 'SomaTech',
            ],
        ];
    }

    private function creativeWorkSchema(array $data): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $data['title'] ?? '',
            'description' => $data['description'] ?? '',
            'image' => $data['image'] ?? '',
            'author' => [
                '@type' => 'Organization',
                'name' => 'SomaTech',
            ],
        ];
    }
}
```

---

## 1.4 Form Request Validation

### SRS Reference: Section 5.5, FR-022, FR-025

#### FormRequest 1: StoreContactRequest
**File:** `app/Http/Requests/StoreContactRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'company' => ['nullable', 'string', 'max:255'],
            'service_interest' => ['required', 'string', 'max:100'],
            'budget_range' => ['nullable', 'string', 'max:100'],
            'message' => ['required', 'string', 'min:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please tell us your name.',
            'email.required' => 'We need your email to get back to you.',
            'email.email' => 'Please provide a valid email address.',
            'service_interest.required' => 'Please select a service you\'re interested in.',
            'message.required' => 'Please share some details about your project.',
            'message.min' => 'Please provide at least 20 characters in your message.',
        ];
    }
}
```

#### FormRequest 2: StoreProjectRequest
**File:** `app/Http/Requests/StoreProjectRequest.php`

```php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'short_description' => ['required', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'tech_stack' => ['nullable', 'array'],
            'tech_stack.*' => ['string', 'max:100'],
            'project_url' => ['nullable', 'url', 'max:500'],
            'github_url' => ['nullable', 'url', 'max:500'],
            'thumbnail' => ['required', 'image', 'max:5120'], // 5MB
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['image', 'max:5120'],
            'status' => ['required', 'in:draft,published,featured'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ];
    }
}
```

---

## 1.5 Mail Classes

**File:** `app/Mail/AdminNotificationMail.php`

```php
<?php

namespace App\Mail;

use App\Models\ContactInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactInquiry $inquiry)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Inquiry from ' . $this->inquiry->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.admin-notification',
        );
    }
}
```

**File:** `app/Mail/ContactConfirmationMail.php`

```php
<?php

namespace App\Mail;

use App\Models\ContactInquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactInquiry $inquiry)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank you for contacting SomaTech',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.contact-confirmation',
        );
    }
}
```

---

## 1.6 Configuration Updates

### Update bootstrap/app.php
**SRS Reference:** Section 3.2, SEC-005 (Rate Limiting)

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'auth'])
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Rate limiters for SRS SEC-005
        RateLimiter::for('contact', function (Request $request) {
            return Limit::perHour(3)->by($request->ip());
        });

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinutes(10, 5)->by($request->ip());
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
```

### Update .env.example

```env
APP_NAME=SomaTech
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_TIMEZONE=UTC
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=somatech
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=log
MAIL_FROM_ADDRESS="hello@somatech.com"
MAIL_FROM_NAME="${APP_NAME}"
MAIL_ADMIN_EMAIL="admin@somatech.com"

QUEUE_CONNECTION=database
```

---

## 1.7 Routes Setup

### Public Routes
**File:** `routes/web.php`
**SRS Reference:** Section 3.3

```php
<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{project:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('contact.store');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
```

### Admin Routes
**File:** `routes/admin.php`
**SRS Reference:** Section 3.3, FR-026 (Auth Required)

```php
<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('projects', ProjectController::class);
Route::get('projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
Route::patch('projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');

Route::get('inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
Route::get('inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');

Route::resource('team', TeamController::class);
Route::resource('testimonials', TestimonialController ::class);
Route::resource('services', ServiceController::class)->except(['show']);
Route::resource('skills', SkillController::class)->except(['show']);
Route::resource('stats', StatController::class)->except(['show']);

Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
Route::post('settings', [SettingsController::class, 'store'])->name('settings.store');
```

---

## 1.8 Commands Summary

Run these commands in order:

```bash
# Create all migrations
php artisan make:migration create_categories_table
php artisan make:migration create_services_table
php artisan make:migration create_projects_table
php artisan make:migration create_team_members_table
php artisan make:migration create_testimonials_table
php artisan make:migration create_contact_inquiries_table
php artisan make:migration create_skills_table
php artisan make:migration create_stats_table
php artisan make:migration create_site_settings_table

# Create all models
php artisan make:model Category
php artisan make:model Service
php artisan make:model Project
php artisan make:model TeamMember
php artisan make:model Testimonial
php artisan make:model ContactInquiry
php artisan make:model Skill
php artisan make:model Stat
php artisan make:model SiteSetting

# Create service classes
php artisan make:class Services/ProjectService
php artisan make:class Services/ContactService
php artisan make:class Services/SeoService

# Create form requests
php artisan make:request StoreContactRequest
php artisan make:request StoreProjectRequest

# Create mail classes
php artisan make:mail AdminNotificationMail
php artisan make:mail ContactConfirmationMail

# Run migrations
php artisan migrate
```

---

## ✅ Step 1 Completion Checklist

- [ ] All 9 database migrations created and executed
- [ ] All 9 Eloquent models with relationships and scopes
- [ ] 3 Service layer classes (ProjectService, ContactService, SeoService)
- [ ] 2 FormRequest validation classes
- [ ] 2 Mail classes with Markdown templates
- [ ] Routes configured (web.php and admin.php)
- [ ] Rate limiting configured in bootstrap/app.php
- [ ] .env.example updated with all required variables

---

**Next Step:** [STEP_02_FRONTEND_UI.md](./STEP_02_FRONTEND_UI.md) - Frontend layouts, Blade components, and Tailwind CSS styling
