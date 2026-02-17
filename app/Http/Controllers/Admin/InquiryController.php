<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\View\View;

class InquiryController extends Controller
{
    /**
     * Display all inquiries.
     * SRS Requirement: FR-029 (paginated, sorted by created_at DESC)
     */
    public function index(): View
    {
        $inquiries = ContactInquiry::recent()->paginate(20);

        return view('admin.inquiries.index', compact('inquiries'));
    }

    /**
     * Show inquiry detail and mark as read.
     * SRS Requirement: FR-029 (mark as read atomically)
     */
    public function show(ContactInquiry $inquiry): View
    {
        $inquiry->markAsRead();

        return view('admin.inquiries.show', compact('inquiry'));
    }
}
