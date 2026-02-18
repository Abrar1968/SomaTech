<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Stat;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display homepage with all sections.
     * SRS Requirements: FR-001 to FR-008
     */
    public function index(): View
    {
        // FR-004: Featured Services (3 services)
        $services = Service::featured()->limit(3)->get();

        // FR-005: Featured Projects (6 projects)
        $projects = Project::with('category')->featured()->limit(6)->get();

        // FR-006: Statistics for counter animation
        $stats = Stat::orderBy('sort_order')->get();

        // FR-007: Featured testimonials for carousel
        $testimonials = Testimonial::with('project')->featured()->get();

        // FR-008: Technology stack skills
        $skills = Skill::orderBy('category')->orderBy('sort_order')->get();

        return view('pages.home', compact(
            'services',
            'projects',
            'stats',
            'testimonials',
            'skills'
        ));
    }
}
