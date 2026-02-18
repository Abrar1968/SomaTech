<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Admin Documentation Controller.
 */
class DocsController extends Controller
{
    public function index(): View
    {
        return view('admin.docs.index');
    }
}
