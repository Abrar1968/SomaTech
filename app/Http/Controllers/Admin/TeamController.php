<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
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

    public function show(TeamMember $team): View
    {
        return view('welcome');
    }

    public function edit(TeamMember $team): View
    {
        return view('welcome');
    }

    public function update(Request $request, TeamMember $team): RedirectResponse
    {
        return redirect()->back();
    }

    public function destroy(TeamMember $team): RedirectResponse
    {
        return redirect()->back();
    }
}
