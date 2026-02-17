<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
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

    public function edit(Skill $skill): View
    {
        return view('welcome');
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        return redirect()->back();
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        return redirect()->back();
    }
}
