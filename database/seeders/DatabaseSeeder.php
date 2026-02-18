<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@somaticx.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('Admin user: admin@somaticx.com / password');

        // Create categories
        $categories = [
            ['name' => 'Web Development', 'slug' => 'web-development'],
            ['name' => 'Mobile Apps', 'slug' => 'mobile-apps'],
            ['name' => 'E-commerce', 'slug' => 'e-commerce'],
            ['name' => 'UI/UX Design', 'slug' => 'ui-ux-design'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // Create services
        Service::factory()->count(4)->create();

        // Create projects
        $cats = Category::all();
        foreach ($cats as $category) {
            Project::factory()->count(3)->create([
                'category_id' => $category->id,
                'status' => fake()->randomElement(['published', 'featured']),
            ]);
        }

        // Create stats
        $stats = [
            ['label' => 'Projects Delivered', 'value' => 120, 'suffix' => '+'],
            ['label' => 'Happy Clients', 'value' => 85, 'suffix' => '+'],
            ['label' => 'Years Experience', 'value' => 5, 'suffix' => '+'],
            ['label' => 'Uptime Guarantee', 'value' => 99, 'suffix' => '%'],
        ];

        foreach ($stats as $stat) {
            Stat::updateOrCreate(['label' => $stat['label']], $stat);
        }

        // Create team members
        TeamMember::factory()->count(6)->create();

        // Create testimonials
        Testimonial::factory()->count(6)->create();

        // Create skills
        $skills = ['Laravel', 'React', 'Vue.js', 'Node.js', 'PHP', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'Swift', 'Kotlin', 'Flutter', 'AWS'];
        foreach ($skills as $skill) {
            Skill::updateOrCreate(['name' => $skill], [
                'name' => $skill,
                'category' => 'Technology',
                'proficiency' => rand(70, 100),
            ]);
        }

        $this->command->info('Database seeded successfully!');
    }
}
