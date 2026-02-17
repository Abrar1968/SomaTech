<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\AdminNotificationMail;
use App\Mail\ContactConfirmationMail;
use App\Models\ContactInquiry;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    /**
     * Store contact inquiry and dispatch notifications.
     *
     * SRS Reference: FR-025
     */
    public function storeInquiry(array $data): ContactInquiry
    {
        $inquiry = ContactInquiry::create([
            ...$data,
            'ip_address' => request()->ip(),
            'status' => 'new',
        ]);

        // Dispatch queued email to admin
        Mail::to(config('mail.admin_email'))
            ->queue(new AdminNotificationMail($inquiry));

        // Send confirmation to client
        Mail::to($inquiry->email)
            ->queue(new ContactConfirmationMail($inquiry));

        return $inquiry;
    }

    /**
     * Get unread inquiries count.
     *
     * SRS Reference: FR-027
     */
    public function getUnreadCount(): int
    {
        return ContactInquiry::unread()->count();
    }

    /**
     * Get recent inquiries for chart.
     *
     * SRS Reference: FR-027
     *
     * @return array<string, int>
     */
    public function getInquiriesLast30Days(): array
    {
        $inquiries = ContactInquiry::where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return $inquiries->pluck('count', 'date')->toArray();
    }
}
