<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProjectService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function __construct(public ProjectService $projectService) {}

    public function index(Request $request): View
    {
        return view('welcome');
    }

    public function show(string $slug): View
    {
        return view('welcome');
    }
}
