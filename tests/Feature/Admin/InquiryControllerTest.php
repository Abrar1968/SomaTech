<?php

declare(strict_types=1);

use App\Models\ContactInquiry;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('requires authentication for inquiries index', function () {
    $response = $this->get(route('admin.inquiries.index'));

    $response->assertRedirect(route('login'));
});

it('paginates inquiries correctly', function () {
    $this->actingAs($this->user);

    ContactInquiry::factory()->count(25)->create();

    expect(ContactInquiry::recent()->paginate(20)->perPage())->toBe(20);
});

it('orders inquiries by most recent first', function () {
    $this->actingAs($this->user);

    $older = ContactInquiry::factory()->create(['created_at' => now()->subDay()]);
    $newer = ContactInquiry::factory()->create(['created_at' => now()]);

    $inquiries = ContactInquiry::recent()->get();

    expect($inquiries->first()->id)->toBe($newer->id);
});

it('marks inquiry as read when viewed', function () {
    $inquiry = ContactInquiry::factory()->create(['status' => 'new']);

    $inquiry->markAsRead();

    expect($inquiry->fresh()->status)->toBe('read');
});

it('sets read_at timestamp when marking as read', function () {
    $inquiry = ContactInquiry::factory()->create([
        'status' => 'new',
        'read_at' => null,
    ]);

    $inquiry->markAsRead();

    expect($inquiry->fresh()->read_at)->not->toBeNull();
});

it('does not change status if already read', function () {
    $readAt = now()->subHour();
    $inquiry = ContactInquiry::factory()->create([
        'status' => 'read',
        'read_at' => $readAt,
    ]);

    $inquiry->markAsRead();

    expect($inquiry->fresh()->read_at->timestamp)->toBe($readAt->timestamp);
});
