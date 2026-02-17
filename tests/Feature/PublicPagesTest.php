<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Stat;
use App\Models\TeamMember;
use App\Models\Testimonial;

it('displays homepage with all required data', function () {
    $category = Category::factory()->create();
    Service::factory()->count(3)->create(['is_featured' => true]);
    Project::factory()->count(6)->create(['status' => 'featured', 'category_id' => $category->id]);
    Stat::factory()->count(4)->create();
    Testimonial::factory()->count(3)->create(['is_featured' => true]);
    Skill::factory()->count(10)->create();

    $response = $this->get(route('home'));

    $response->assertSuccessful()
        ->assertViewIs('pages.home')
        ->assertViewHas('services')
        ->assertViewHas('projects')
        ->assertViewHas('stats')
        ->assertViewHas('testimonials')
        ->assertViewHas('skills');
});

it('limits homepage services to 3', function () {
    Service::factory()->count(5)->create(['is_featured' => true]);

    $response = $this->get(route('home'));

    $response->assertViewHas('services', function ($services) {
        return $services->count() <= 3;
    });
});

it('limits homepage projects to 6', function () {
    $category = Category::factory()->create();
    Project::factory()->count(10)->create(['status' => 'featured', 'category_id' => $category->id]);

    $response = $this->get(route('home'));

    $response->assertViewHas('projects', function ($projects) {
        return $projects->count() <= 6;
    });
});

it('displays about page with team members', function () {
    TeamMember::factory()->count(4)->create(['is_active' => true]);

    $response = $this->get(route('about'));

    $response->assertSuccessful()
        ->assertViewIs('pages.about')
        ->assertViewHas('team');
});

it('displays only active team members on about page', function () {
    TeamMember::factory()->count(3)->create(['is_active' => true]);
    TeamMember::factory()->count(2)->create(['is_active' => false]);

    $response = $this->get(route('about'));

    $response->assertViewHas('team', function ($team) {
        return $team->count() === 3;
    });
});

it('displays services index', function () {
    Service::factory()->count(3)->create();

    $response = $this->get(route('services.index'));

    $response->assertSuccessful()
        ->assertViewIs('pages.services.index')
        ->assertViewHas('services');
});

it('displays single service detail', function () {
    $service = Service::factory()->create(['slug' => 'web-development']);

    $response = $this->get(route('services.show', $service));

    $response->assertSuccessful()
        ->assertViewIs('pages.services.show')
        ->assertViewHas('service');
});

it('generates xml sitemap', function () {
    $category = Category::factory()->create();
    Project::factory()->count(3)->create(['status' => 'published', 'category_id' => $category->id]);
    Service::factory()->count(2)->create();

    $response = $this->get(route('sitemap'));

    $response->assertSuccessful()
        ->assertHeader('Content-Type', 'application/xml');
});
