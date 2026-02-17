<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\TeamMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeamMember>
 */
class TeamMemberFactory extends Factory
{
    protected $model = TeamMember::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'role' => fake()->randomElement([
                'Full Stack Developer',
                'Frontend Developer',
                'Backend Developer',
                'UI/UX Designer',
                'Project Manager',
                'DevOps Engineer',
            ]),
            'bio' => fake()->paragraph(),
            'photo' => null,
            'linkedin_url' => fake()->optional()->url(),
            'github_url' => fake()->optional()->url(),
            'skills' => fake()->randomElements([
                'PHP', 'JavaScript', 'Laravel', 'React', 'Vue.js',
                'Tailwind CSS', 'MySQL', 'Docker', 'Git',
            ], 4),
            'sort_order' => fake()->numberBetween(0, 10),
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
