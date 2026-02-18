<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Admin Stat Controller.
 *
 * SRS Requirements: FR-013
 */
class StatController extends Controller
{
    public function index(): View
    {
        $stats = Stat::query()
            ->orderBy('sort_order')
            ->get();

        return view('admin.stats.index', compact('stats'));
    }

    public function create(): View
    {
        return view('admin.stats.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'prefix' => 'nullable|string|max:10',
            'suffix' => 'nullable|string|max:10',
            'icon' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        Stat::create($validated);

        return redirect()->route('admin.stats.index')
            ->with('success', 'Stat created successfully.');
    }

    public function edit(Stat $stat): View
    {
        return view('admin.stats.edit', compact('stat'));
    }

    public function update(Request $request, Stat $stat): RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'prefix' => 'nullable|string|max:10',
            'suffix' => 'nullable|string|max:10',
            'icon' => 'nullable|string|max:10',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $stat->update($validated);

        return redirect()->route('admin.stats.index')
            ->with('success', 'Stat updated successfully.');
    }

    public function destroy(Stat $stat): RedirectResponse
    {
        $stat->delete();

        return redirect()->route('admin.stats.index')
            ->with('success', 'Stat deleted successfully.');
    }
}
