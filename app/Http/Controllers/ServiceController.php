<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function show(Service $service): View
    {
        return view('welcome');
    }
}
