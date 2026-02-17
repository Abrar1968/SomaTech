<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
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

    public function edit(Service $service): View
    {
        return view('welcome');
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        return redirect()->back();
    }

    public function destroy(Service $service): RedirectResponse
    {
        return redirect()->back();
    }
}
