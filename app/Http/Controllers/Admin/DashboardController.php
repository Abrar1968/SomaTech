<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Admin dashboard with KPIs.
     *
     * SRS Requirement: FR-027
     */
    public function index(): View
    {
        $stats = [
            'projects' => Project::count(),
            'services' => Service::count(),
            'inquiries' => ContactInquiry::unread()->count(),
            'testimonials' => Testimonial::count(),
        ];

        $recentInquiries = ContactInquiry::query()
            ->latest()
            ->take(5)
            ->get();

        $recentProjects = Project::query()
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentInquiries',
            'recentProjects'
        ));
    }
}
