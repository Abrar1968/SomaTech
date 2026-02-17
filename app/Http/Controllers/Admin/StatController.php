<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StatController extends Controller
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

    public function edit(Stat $stat): View
    {
        return view('welcome');
    }

    public function update(Request $request, Stat $stat): RedirectResponse
    {
        return redirect()->back();
    }

    public function destroy(Stat $stat): RedirectResponse
    {
        return redirect()->back();
    }
}
