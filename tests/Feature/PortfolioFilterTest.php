<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Project;

it('displays portfolio index with all projects', function () {
    $category = Category::factory()->create();
    Project::factory()->count(5)->create(['status' => 'published', 'category_id' => $category->id]);

    $response = $this->get(route('portfolio.index'));

    $response->assertSuccessful()
        ->assertViewIs('pages.portfolio.index')
        ->assertViewHas('projects')
        ->assertViewHas('categories');
});

it('filters projects by category', function () {
    $category1 = Category::factory()->create(['name' => 'Web Development']);
    $category2 = Category::factory()->create(['name' => 'App Development']);

    Project::factory()->count(5)->create(['status' => 'published', 'category_id' => $category1->id]);
    Project::factory()->count(3)->create(['status' => 'published', 'category_id' => $category2->id]);

    $response = $this->get(route('portfolio.index', ['category' => $category1->id]));

    $response->assertSuccessful()
        ->assertViewHas('projects', function ($projects) {
            return $projects->total() === 5;
        });
});

it('returns all projects when no category filter', function () {
    $category1 = Category::factory()->create();
    $category2 = Category::factory()->create();

    Project::factory()->count(3)->create(['status' => 'published', 'category_id' => $category1->id]);
    Project::factory()->count(2)->create(['status' => 'published', 'category_id' => $category2->id]);

    $response = $this->get(route('portfolio.index'));

    $response->assertSuccessful()
        ->assertViewHas('projects', function ($projects) {
            return $projects->total() === 5;
        });
});

it('displays categories with project counts', function () {
    $category = Category::factory()->create();
    Project::factory()->count(5)->create(['status' => 'published', 'category_id' => $category->id]);

    $response = $this->get(route('portfolio.index'));

    $response->assertViewHas('categories', function ($categories) {
        return $categories->first()->projects_count === 5;
    });
});

it('displays single project case study', function () {
    $category = Category::factory()->create();
    $project = Project::factory()->create([
        'status' => 'published',
        'category_id' => $category->id,
        'slug' => 'test-project',
    ]);

    $response = $this->get(route('portfolio.show', $project->slug));

    $response->assertSuccessful()
        ->assertViewIs('pages.portfolio.show')
        ->assertViewHas('project')
        ->assertViewHas('adjacent');
});

it('includes adjacent projects in case study view', function () {
    $category = Category::factory()->create();
    Project::factory()->create(['status' => 'published', 'sort_order' => 1, 'category_id' => $category->id]);
    $project = Project::factory()->create([
        'status' => 'published',
        'sort_order' => 2,
        'category_id' => $category->id,
        'slug' => 'middle-project',
    ]);
    Project::factory()->create(['status' => 'published', 'sort_order' => 3, 'category_id' => $category->id]);

    $response = $this->get(route('portfolio.show', $project->slug));

    $response->assertViewHas('adjacent', function ($adjacent) {
        return $adjacent['previous'] !== null && $adjacent['next'] !== null;
    });
});

it('paginates projects in portfolio index', function () {
    $category = Category::factory()->create();
    Project::factory()->count(25)->create(['status' => 'published', 'category_id' => $category->id]);

    $response = $this->get(route('portfolio.index'));

    $response->assertViewHas('projects', function ($projects) {
        return $projects->perPage() === 12;
    });
});

it('excludes draft projects from portfolio', function () {
    $category = Category::factory()->create();
    Project::factory()->count(3)->create(['status' => 'draft', 'category_id' => $category->id]);
    Project::factory()->count(2)->create(['status' => 'published', 'category_id' => $category->id]);

    $response = $this->get(route('portfolio.index'));

    $response->assertViewHas('projects', function ($projects) {
        return $projects->total() === 2;
    });
});
