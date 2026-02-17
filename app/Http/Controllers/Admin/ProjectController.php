<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function create(): View
    {
        return view('welcome');
    }

    public function store(Request $request): RedirectResponse
    {
        return redirect()->back();
    }

    public function show(Project $project): View
    {
        return view('welcome');
    }

    public function edit(Project $project): View
    {
        return view('welcome');
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        return redirect()->back();
    }

    public function destroy(Project $project): RedirectResponse
    {
        return redirect()->back();
    }

    public function trash(): View
    {
        return view('welcome');
    }

    public function restore(Project $project): RedirectResponse
    {
        return redirect()->back();
    }
}
