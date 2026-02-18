<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\StatController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('projects', ProjectController::class);
Route::get('projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
Route::patch('projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore');

Route::get('inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
Route::get('inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');

Route::resource('team', TeamController::class);
Route::resource('testimonials', TestimonialController::class);
Route::resource('services', ServiceController::class)->except(['show']);
Route::resource('skills', SkillController::class)->except(['show']);
Route::resource('stats', StatController::class)->except(['show']);

Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
