<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Service;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(private ContactService $contactService) {}

    /**
     * Display contact page.
     * SRS Requirements: FR-021, FR-022
     */
    public function index(): View
    {
        // FR-022: Populate service dropdown
        $services = Service::orderBy('title')->get();

        return view('pages.contact', compact('services'));
    }

    /**
     * Store contact inquiry.
     * SRS Requirement: FR-025
     * Rate limited to 3 per hour per IP (SEC-005)
     */
    public function store(StoreContactRequest $request): JsonResponse
    {
        $this->contactService->storeInquiry($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Thank you! We will get back to you soon.',
        ], 201);
    }
}
