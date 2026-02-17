<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\View\View;

class InquiryController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function show(ContactInquiry $inquiry): View
    {
        return view('welcome');
    }
}
