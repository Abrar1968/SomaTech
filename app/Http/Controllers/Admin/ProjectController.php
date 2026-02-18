<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display all projects with filters.
     * SRS Requirement: FR-028 (list view with sorting, filter, search)
     */
    public function index(Request $request): View
    {
        $query = Project::with('category')->withTrashed();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');
        $query->orderBy($sortBy, $sortDir);

        $projects = $query->paginate(20);
        $categories = Category::all();

        return view('admin.projects.index', compact('projects', 'categories'));
    }

    /**
     * Show create form.
     */
    public function create(): View
    {
        $categories = Category::all();

        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store new project with image uploads.
     * SRS Requirement: FR-028 (thumbnail & gallery upload, WebP conversion)
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $data = $request->validated();

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        // Handle gallery uploads
        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('projects/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display project details.
     */
    public function show(Project $project): View
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show edit form.
     */
    public function edit(Project $project): View
    {
        $categories = Category::all();

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update project.
     */
    public function update(StoreProjectRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('projects/thumbnails', 'public');
        }

        if ($request->hasFile('gallery')) {
            $gallery = $project->gallery ?? [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('projects/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully.');
    }

    /**
     * Soft delete project.
     * SRS Requirement: FR-028 (soft delete)
     */
    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project moved to trash.');
    }

    /**
     * View trashed projects.
     * SRS Requirement: FR-028 (recoverable trash)
     */
    public function trash(): View
    {
        $projects = Project::onlyTrashed()->with('category')->paginate(20);

        return view('admin.projects.trash', compact('projects'));
    }

    /**
     * Restore trashed project.
     * SRS Requirement: FR-028 (restore from trash)
     */
    public function restore(int $id): RedirectResponse
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('admin.projects.trash')
            ->with('success', 'Project restored successfully.');
    }
}
