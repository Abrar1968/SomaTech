<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Display all services.
     * SRS Requirement: FR-013, FR-015
     */
    public function index(): View
    {
        $services = Service::orderBy('sort_order')->get();

        return view('pages.services.index', compact('services'));
    }

    /**
     * Display single service detail.
     * SRS Requirement: FR-014
     */
    public function show(Service $service): View
    {
        return view('pages.services.show', compact('service'));
    }
}
