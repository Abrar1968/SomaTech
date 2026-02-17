<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ContactInquiry;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactInquiry>
 */
class ContactInquiryFactory extends Factory
{
    protected $model = ContactInquiry::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'phone' => fake()->optional()->phoneNumber(),
            'company' => fake()->optional()->company(),
            'service_interest' => fake()->randomElement([
                'Website Development',
                'App Development',
                'Website Maintenance',
            ]),
            'budget_range' => fake()->randomElement([
                '$1,000 - $5,000',
                '$5,000 - $10,000',
                '$10,000 - $25,000',
                '$25,000+',
            ]),
            'message' => fake()->paragraphs(2, true),
            'ip_address' => fake()->ipv4(),
            'status' => 'new',
            'read_at' => null,
            'replied_at' => null,
        ];
    }

    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'read',
            'read_at' => now(),
        ]);
    }

    public function replied(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'replied',
            'read_at' => now()->subHour(),
            'replied_at' => now(),
        ]);
    }

    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'archived',
            'read_at' => now()->subDay(),
            'replied_at' => now()->subHours(12),
        ]);
    }
}
