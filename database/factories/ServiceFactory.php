<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    protected $model = Service::class;

    public function definition(): array
    {
        $title = fake()->unique()->randomElement([
            'Website Development',
            'App Development',
            'Website Maintenance',
            'UI/UX Design',
            'Cloud Hosting',
            'SEO Optimization',
        ]);

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'tagline' => fake()->sentence(),
            'description' => fake()->paragraphs(3, true),
            'icon' => null,
            'features' => fake()->randomElements([
                'Responsive Design',
                'SEO Optimized',
                'Fast Loading',
                'Secure',
                'Scalable',
                'Custom Built',
            ], 3),
            'technologies' => fake()->randomElements([
                'Laravel', 'React', 'Vue.js', 'Tailwind CSS', 'MySQL', 'Redis',
            ], 3),
            'is_featured' => false,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }
}
