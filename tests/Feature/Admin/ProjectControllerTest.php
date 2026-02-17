<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->category = Category::factory()->create();
    Storage::fake('public');
});

it('requires authentication to access admin projects', function () {
    $response = $this->get(route('admin.projects.index'));

    $response->assertRedirect(route('login'));
});

it('soft deletes project', function () {
    $this->actingAs($this->user);

    $project = Project::factory()->create(['category_id' => $this->category->id]);

    $this->delete(route('admin.projects.destroy', $project));

    expect(Project::count())->toBe(0)
        ->and(Project::withTrashed()->count())->toBe(1);
});

it('restores soft deleted project', function () {
    $this->actingAs($this->user);

    $project = Project::factory()->create(['category_id' => $this->category->id]);
    $project->delete();

    $this->patch(route('admin.projects.restore', $project->id));

    expect(Project::count())->toBe(1);
});

it('filters projects by status using query', function () {
    $this->actingAs($this->user);

    Project::factory()->create(['status' => 'published', 'category_id' => $this->category->id]);
    Project::factory()->create(['status' => 'draft', 'category_id' => $this->category->id]);

    expect(Project::where('status', 'published')->count())->toBe(1);
});

it('searches projects by title using query', function () {
    $this->actingAs($this->user);

    Project::factory()->create(['title' => 'Alpha Project', 'category_id' => $this->category->id]);
    Project::factory()->create(['title' => 'Beta Project', 'category_id' => $this->category->id]);

    expect(Project::where('title', 'like', '%Alpha%')->count())->toBe(1);
});

it('handles soft delete scope correctly', function () {
    $project1 = Project::factory()->create(['category_id' => $this->category->id]);
    $project2 = Project::factory()->create(['category_id' => $this->category->id]);

    $project1->delete();

    expect(Project::count())->toBe(1)
        ->and(Project::withTrashed()->count())->toBe(2)
        ->and(Project::onlyTrashed()->count())->toBe(1);
});

it('stores project thumbnail correctly', function () {
    $thumbnail = UploadedFile::fake()->image('thumbnail.jpg');
    $path = $thumbnail->store('projects/thumbnails', 'public');

    Storage::disk('public')->assertExists($path);
});

it('stores project gallery correctly', function () {
    $gallery = [];
    foreach ([
        UploadedFile::fake()->image('gallery1.jpg'),
        UploadedFile::fake()->image('gallery2.jpg'),
    ] as $image) {
        $gallery[] = $image->store('projects/gallery', 'public');
    }

    expect($gallery)->toHaveCount(2);

    foreach ($gallery as $path) {
        Storage::disk('public')->assertExists($path);
    }
});
