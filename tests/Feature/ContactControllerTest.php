<?php

declare(strict_types=1);

use App\Mail\AdminNotificationMail;
use App\Mail\ContactConfirmationMail;
use App\Models\ContactInquiry;
use App\Models\Service;
use Illuminate\Support\Facades\Mail;

beforeEach(function () {
    Mail::fake();
    Service::factory()->create(['title' => 'Website Development']);
});

it('displays contact page with services', function () {
    $response = $this->get(route('contact.index'));

    $response->assertSuccessful()
        ->assertViewIs('pages.contact')
        ->assertViewHas('services');
});

it('stores contact inquiry successfully', function () {
    $response = $this->postJson(route('contact.store'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '555-1234',
        'company' => 'Acme Inc',
        'service_interest' => 'Website Development',
        'budget_range' => '$10,000 - $25,000',
        'message' => 'I need a new website for my business that showcases our products.',
    ]);

    $response->assertStatus(201)
        ->assertJson([
            'success' => true,
            'message' => 'Thank you! We will get back to you soon.',
        ]);

    expect(ContactInquiry::count())->toBe(1);

    Mail::assertQueued(AdminNotificationMail::class);
    Mail::assertQueued(ContactConfirmationMail::class);
});

it('validates required fields', function () {
    $response = $this->postJson(route('contact.store'), [
        'name' => '',
        'email' => 'invalid-email',
        'message' => 'Too short',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['name', 'email', 'service_interest', 'message']);
});

it('validates email format', function () {
    $response = $this->postJson(route('contact.store'), [
        'name' => 'John Doe',
        'email' => 'not-an-email',
        'service_interest' => 'Website Development',
        'message' => 'This is a test message with enough characters.',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['email']);
});

it('validates message minimum length', function () {
    $response = $this->postJson(route('contact.store'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'service_interest' => 'Website Development',
        'message' => 'Short',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors(['message']);
});

it('stores ip address with inquiry', function () {
    $this->postJson(route('contact.store'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'service_interest' => 'Website Development',
        'message' => 'This is a test message with enough characters for validation.',
    ]);

    $inquiry = ContactInquiry::first();
    expect($inquiry->ip_address)->not->toBeNull();
});

it('sets status to new for new inquiries', function () {
    $this->postJson(route('contact.store'), [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'service_interest' => 'Website Development',
        'message' => 'This is a test message with enough characters for validation.',
    ]);

    $inquiry = ContactInquiry::first();
    expect($inquiry->status)->toBe('new');
});

it('enforces rate limiting', function () {
    $data = [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'service_interest' => 'Website Development',
        'message' => 'This is a test message with enough characters.',
    ];

    // Send 3 requests (the limit)
    for ($i = 0; $i < 3; $i++) {
        $this->postJson(route('contact.store'), $data)->assertStatus(201);
    }

    // 4th request should be rate limited
    $this->postJson(route('contact.store'), $data)->assertStatus(429);
});
