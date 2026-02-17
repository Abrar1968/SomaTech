<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function __construct(private ProjectService $projectService) {}

    /**
     * Display portfolio grid with filtering.
     * SRS Requirements: FR-017, FR-018, FR-019
     */
    public function index(Request $request): View
    {
        $categoryId = $request->query('category');
        $categoryId = $categoryId !== null ? (int) $categoryId : null;

        $projects = $this->projectService->getAllPublished($categoryId);
        $categories = Category::withCount('projects')->get();

        return view('pages.portfolio.index', compact('projects', 'categories', 'categoryId'));
    }

    /**
     * Display single project case study.
     * SRS Requirement: FR-020
     */
    public function show(string $slug): View
    {
        $project = $this->projectService->getBySlug($slug);
        $adjacent = $this->projectService->getAdjacentProjects($project);

        return view('pages.portfolio.show', compact('project', 'adjacent'));
    }
}
