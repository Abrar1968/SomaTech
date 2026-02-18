<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * Scope to get published and featured projects.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->whereIn('status', ['published', 'featured']);
    }

    /**
     * Scope to get only featured projects ordered by sort_order.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('status', 'featured')->orderBy('sort_order');
    }

    /**
     * Scope to filter projects by category.
     */
    public function scopeByCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Get the SEO meta title, falling back to project title.
     */
    public function getMetaTitleAttribute(?string $value): string
    {
        return $value ?? $this->title;
    }

    /**
     * Get the SEO meta description, falling back to short description.
     */
    public function getMetaDescriptionAttribute(?string $value): string
    {
        return $value ?? $this->short_description;
    }
}
