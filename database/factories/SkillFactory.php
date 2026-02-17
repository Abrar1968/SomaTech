<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    protected $model = Skill::class;

    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'PHP', 'JavaScript', 'TypeScript', 'Python',
                'Laravel', 'React', 'Vue.js', 'Node.js',
                'MySQL', 'PostgreSQL', 'Redis', 'Docker',
                'Tailwind CSS', 'SASS', 'Git', 'AWS',
            ]),
            'category' => fake()->randomElement([
                'Frontend', 'Backend', 'Database', 'DevOps', 'Mobile',
            ]),
            'proficiency' => fake()->numberBetween(70, 100),
            'icon' => null,
            'sort_order' => fake()->numberBetween(0, 10),
        ];
    }
}
