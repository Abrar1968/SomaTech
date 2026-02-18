<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Support\Facades\Hash;

it('displays login page', function () {
    $response = $this->get(route('login'));

    $response->assertSuccessful()
        ->assertSee('Admin Login')
        ->assertSee('Email Address')
        ->assertSee('Password');
});

it('allows valid credentials to login', function () {
    $user = User::factory()->create([
        'email' => 'test@admin.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'test@admin.com',
        'password' => 'password123',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticatedAs($user);
});

it('rejects invalid credentials', function () {
    User::factory()->create([
        'email' => 'test@admin.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->post(route('login.store'), [
        'email' => 'test@admin.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertGuest();
});

it('allows authenticated user to logout', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post(route('logout'));

    $response->assertRedirect(route('home'));
    $this->assertGuest();
});

it('redirects guests from admin routes to login', function () {
    $response = $this->get(route('admin.dashboard'));

    $response->assertRedirect(route('login'));
});

it('allows authenticated users to access admin dashboard', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->get(route('admin.dashboard'));

    $response->assertSuccessful();
});
