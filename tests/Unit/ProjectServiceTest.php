<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Project;
use App\Services\ProjectService;

beforeEach(function () {
    $this->service = new ProjectService;
    $this->category = Category::factory()->create();
});

it('returns featured projects limited to specified count', function () {
    Project::factory()->count(10)->create([
        'status' => 'featured',
        'category_id' => $this->category->id,
    ]);

    $featured = $this->service->getFeatured(6);

    expect($featured)->toHaveCount(6);
});

it('returns only published projects', function () {
    Project::factory()->create(['status' => 'draft', 'category_id' => $this->category->id]);
    Project::factory()->count(5)->create(['status' => 'published', 'category_id' => $this->category->id]);

    $projects = $this->service->getAllPublished();

    expect($projects->total())->toBe(5);
});

it('filters projects by category', function () {
    $category2 = Category::factory()->create();

    Project::factory()->count(3)->create(['status' => 'published', 'category_id' => $this->category->id]);
    Project::factory()->count(2)->create(['status' => 'published', 'category_id' => $category2->id]);

    $projects = $this->service->getAllPublished($this->category->id);

    expect($projects->total())->toBe(3);
});

it('returns adjacent projects correctly', function () {
    $project1 = Project::factory()->create(['status' => 'published', 'sort_order' => 1, 'category_id' => $this->category->id]);
    $project2 = Project::factory()->create(['status' => 'published', 'sort_order' => 2, 'category_id' => $this->category->id]);
    $project3 = Project::factory()->create(['status' => 'published', 'sort_order' => 3, 'category_id' => $this->category->id]);

    $adjacent = $this->service->getAdjacentProjects($project2);

    expect($adjacent['previous']->id)->toBe($project1->id)
        ->and($adjacent['next']->id)->toBe($project3->id);
});

it('returns null for previous when at first project', function () {
    $project1 = Project::factory()->create(['status' => 'published', 'sort_order' => 1, 'category_id' => $this->category->id]);
    Project::factory()->create(['status' => 'published', 'sort_order' => 2, 'category_id' => $this->category->id]);

    $adjacent = $this->service->getAdjacentProjects($project1);

    expect($adjacent['previous'])->toBeNull()
        ->and($adjacent['next'])->not->toBeNull();
});

it('returns null for next when at last project', function () {
    Project::factory()->create(['status' => 'published', 'sort_order' => 1, 'category_id' => $this->category->id]);
    $project2 = Project::factory()->create(['status' => 'published', 'sort_order' => 2, 'category_id' => $this->category->id]);

    $adjacent = $this->service->getAdjacentProjects($project2);

    expect($adjacent['previous'])->not->toBeNull()
        ->and($adjacent['next'])->toBeNull();
});

it('includes featured projects in published scope', function () {
    Project::factory()->create(['status' => 'featured', 'category_id' => $this->category->id]);
    Project::factory()->create(['status' => 'published', 'category_id' => $this->category->id]);
    Project::factory()->create(['status' => 'draft', 'category_id' => $this->category->id]);

    $projects = $this->service->getAllPublished();

    expect($projects->total())->toBe(2);
});

it('returns total project count', function () {
    Project::factory()->count(15)->create(['category_id' => $this->category->id]);

    expect($this->service->getTotalCount())->toBe(15);
});
