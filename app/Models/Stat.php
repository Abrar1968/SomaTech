<?php

declare(strict_types=1);

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

    /**
     * Get the formatted stat value with prefix and suffix.
     */
    public function getFormattedValueAttribute(): string
    {
        return ($this->prefix ?? '').$this->value.($this->suffix ?? '');
    }
}
