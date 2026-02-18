<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProjectService
{
    /**
     * Get all published projects with eager loading.
     */
    public function getAllPublished(?int $categoryId = null, int $perPage = 12): LengthAwarePaginator
    {
        return Project::with('category')
            ->published()
            ->when($categoryId, fn ($query) => $query->byCategory($categoryId))
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Get featured projects for homepage.
     *
     * SRS Reference: FR-005
     */
    public function getFeatured(int $limit = 6): Collection
    {
        return Project::with('category')
            ->featured()
            ->limit($limit)
            ->get();
    }

    /**
     * Get project by slug with relationships.
     */
    public function getBySlug(string $slug): ?Project
    {
        return Project::with(['category', 'testimonials'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();
    }

    /**
     * Get previous and next projects for navigation.
     *
     * SRS Reference: FR-020
     *
     * @return array{previous: Project|null, next: Project|null}
     */
    public function getAdjacentProjects(Project $project): array
    {
        $previous = Project::published()
            ->where('sort_order', '<', $project->sort_order)
            ->orderBy('sort_order', 'desc')
            ->first();

        $next = Project::published()
            ->where('sort_order', '>', $project->sort_order)
            ->orderBy('sort_order')
            ->first();

        return [
            'previous' => $previous,
            'next' => $next,
        ];
    }

    /**
     * Get projects count for admin dashboard.
     *
     * SRS Reference: FR-027
     */
    public function getTotalCount(): int
    {
        return Project::count();
    }
}
