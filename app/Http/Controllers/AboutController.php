<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TeamMember;
use Illuminate\View\View;

class AboutController extends Controller
{
    /**
     * Display about page.
     * SRS Requirements: FR-009 to FR-012
     */
    public function index(): View
    {
        // FR-011: Active team members for flip cards
        $team = TeamMember::active()->get();

        return view('pages.about', compact('team'));
    }
}
