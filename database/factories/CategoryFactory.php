<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = fake()->unique()->randomElement([
            'Web Development',
            'App Development',
            'UI/UX Design',
            'E-Commerce',
            'Cloud Solutions',
            'Digital Marketing',
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'icon' => null,
        ];
    }
}
