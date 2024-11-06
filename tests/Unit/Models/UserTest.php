<?php

use App\Enums\RoleEnum;
use App\Models\User;

beforeEach(function () {
    [
        'admin' => $this->admin,
        'user' => $this->user,
    ] = createDefaultStructure();
});

it('creates a user with the regular role by default', function () {
    $user = User::factory()->create();

    expect($user->role)->toBe(RoleEnum::REGULAR);
});

it('can create a user with the admin role', function () {
    $user = User::factory()->admin()->create();

    expect($user->role)->toBe(RoleEnum::ADMIN);
});

it('hashes the password when setting it', function () {
    $user = User::factory()->create(['password' => 'plain-text']);

    expect($user->password)
        ->not
        ->toBe('plain-text')
        ->and(password_verify('plain-text', $user->password))
        ->toBeTrue();
});
