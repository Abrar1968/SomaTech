<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => ucwords($title),
            'slug' => Str::slug($title),
            'category_id' => Category::factory(),
            'short_description' => fake()->sentence(10),
            'description' => fake()->paragraphs(5, true),
            'client_name' => fake()->company(),
            'tech_stack' => fake()->randomElements([
                'Laravel', 'React', 'Vue.js', 'Tailwind CSS',
                'MySQL', 'Redis', 'Docker', 'AWS',
            ], 4),
            'project_url' => fake()->optional()->url(),
            'github_url' => fake()->optional()->url(),
            'thumbnail' => 'projects/thumbnails/'.fake()->uuid().'.webp',
            'gallery' => null,
            'status' => 'draft',
            'start_date' => fake()->dateTimeBetween('-1 year', '-3 months'),
            'end_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'sort_order' => fake()->numberBetween(0, 20),
            'meta_title' => null,
            'meta_description' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
        ]);
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'featured',
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'draft',
        ]);
    }
}
