<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SiteSetting>
 */
class SiteSettingFactory extends Factory
{
    protected $model = SiteSetting::class;

    public function definition(): array
    {
        return [
            'key' => fake()->unique()->word().'.'.fake()->word(),
            'value' => fake()->sentence(),
            'group' => fake()->randomElement(['general', 'seo', 'social', 'contact']),
            'type' => 'text',
        ];
    }
}
