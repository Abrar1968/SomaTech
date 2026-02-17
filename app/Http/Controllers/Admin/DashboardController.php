<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use App\Models\Project;
use App\Models\TeamMember;
use App\Services\ContactService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(private ContactService $contactService) {}

    /**
     * Admin dashboard with KPIs.
     * SRS Requirement: FR-027
     */
    public function index(): View
    {
        $totalProjects = Project::count();
        $unreadInquiries = $this->contactService->getUnreadCount();
        $activeTeamMembers = TeamMember::where('is_active', true)->count();
        $inquiriesChart = $this->contactService->getInquiriesLast30Days();

        $oldestUnread = ContactInquiry::unread()
            ->orderBy('created_at')
            ->first();

        return view('admin.dashboard', compact(
            'totalProjects',
            'unreadInquiries',
            'activeTeamMembers',
            'inquiriesChart',
            'oldestUnread'
        ));
    }
}
