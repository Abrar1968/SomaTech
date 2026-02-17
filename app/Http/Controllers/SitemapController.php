<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate XML sitemap.
     * SRS Requirement: NFR-013
     */
    public function index(): Response
    {
        $projects = Project::published()->get();
        $services = Service::all();

        $xml = view('sitemap', compact('projects', 'services'))->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
