<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Testimonial>
 */
class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        return [
            'client_name' => fake()->name(),
            'client_company' => fake()->company(),
            'client_role' => fake()->randomElement([
                'CEO', 'CTO', 'Product Manager', 'Marketing Director', 'Founder',
            ]),
            'client_photo' => null,
            'content' => fake()->paragraph(3),
            'rating' => fake()->numberBetween(4, 5),
            'project_id' => null,
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

    public function forProject(Project $project): static
    {
        return $this->state(fn (array $attributes) => [
            'project_id' => $project->id,
        ]);
    }
}
