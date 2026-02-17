<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TestimonialController extends Controller
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

    public function show(Testimonial $testimonial): View
    {
        return view('welcome');
    }

    public function edit(Testimonial $testimonial): View
    {
        return view('welcome');
    }

    public function update(Request $request, Testimonial $testimonial): RedirectResponse
    {
        return redirect()->back();
    }

    public function destroy(Testimonial $testimonial): RedirectResponse
    {
        return redirect()->back();
    }
}
