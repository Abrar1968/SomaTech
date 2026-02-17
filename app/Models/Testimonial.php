<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * Scope to get featured testimonials ordered by sort_order.
     */
    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true)->orderBy('sort_order');
    }

    /**
     * Get the client's initials for avatar fallback.
     */
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
