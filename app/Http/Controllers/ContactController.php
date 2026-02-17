<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function __construct(public ContactService $contactService) {}

    public function index(): View
    {
        return view('welcome');
    }

    public function store(StoreContactRequest $request): JsonResponse
    {
        return response()->json(['message' => 'OK']);
    }
}
