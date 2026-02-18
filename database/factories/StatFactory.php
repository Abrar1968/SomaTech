<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Stat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stat>
 */
class StatFactory extends Factory
{
    protected $model = Stat::class;

    public function definition(): array
    {
        return [
            'label' => fake()->randomElement([
                'Projects Delivered',
                'Happy Clients',
                'Years Experience',
                'Team Members',
                'Lines of Code',
                'Cups of Coffee',
            ]),
            'value' => fake()->numberBetween(10, 500),
            'prefix' => null,
            'suffix' => fake()->optional()->randomElement(['+', 'K', '%']),
            'icon' => null,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
