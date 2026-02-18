<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

/**
 * Admin Settings Controller.
 *
 * SRS Requirements: FR-025
 */
class SettingsController extends Controller
{
    /**
     * File upload fields and their settings.
     *
     * @var array<string, array{path: string, maxSize: int}>
     */
    private array $fileFields = [
        'site_logo' => ['path' => 'branding', 'maxSize' => 2048],
        'site_favicon' => ['path' => 'branding', 'maxSize' => 1024],
        'site_logo_light' => ['path' => 'branding', 'maxSize' => 2048],
        'og_image' => ['path' => 'branding', 'maxSize' => 2048],
    ];

    public function index(): View
    {
        $settings = SiteSetting::all()->pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        // Handle text settings
        $settings = $request->input('settings', []);

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // Handle file uploads
        foreach ($this->fileFields as $field => $config) {
            if ($request->hasFile($field)) {
                $request->validate([
                    $field => ['image', 'max:'.$config['maxSize']],
                ]);

                // Delete old file if exists
                $oldPath = SiteSetting::get($field);
                if ($oldPath && Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }

                // Store new file
                $path = $request->file($field)->store($config['path'], 'public');
                SiteSetting::set($field, $path);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings saved successfully.');
    }
}
