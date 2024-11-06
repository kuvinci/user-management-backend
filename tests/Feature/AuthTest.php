<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

beforeEach(function () {
    [
        'admin' => $this->admin,
        'user' => $this->user,
    ] = createDefaultStructure();

    Auth::logout();
});

it('allows a user to log in', function () {
    $user = User::factory()->create([
        'email'    => 'test@example.com',
        'password' => 'password',
    ]);

    $response = $this->post('/api/v1/login', [
        'email'    => 'test@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200);
    $this->assertAuthenticatedAs($user);
});

it('prevents login with invalid credentials', function () {
    $response = $this->post('/api/v1/login', [
        'email'    => 'wrong@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(401);
    $this->assertGuest();
});

it('allows authenticated user to access protected route', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $response = $this->get('/api/v1/user');

    $response->assertStatus(200);
    $response->assertJson(['email' => $user->email]);
});

it('prevents unauthenticated user from accessing protected route', function () {
    // todo: figure out authentication issues
    $response = $this->get('/api/v1/user');

    $response->assertStatus(401);
})->skip();
