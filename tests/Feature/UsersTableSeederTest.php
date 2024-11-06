<?php

use App\Enums\RoleEnum;
use App\Models\User;
use Database\Seeders\UsersTableSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    [
        'admin' => $this->admin,
        'user' => $this->user,
    ] = createDefaultStructure();

    uses(RefreshDatabase::class);
});

it('seeds the users table with correct roles', function () {
    $this->seed(UsersTableSeeder::class);

    $this->assertDatabaseHas('users', [
        'email' => 'admin@example.com',
        'role' => RoleEnum::ADMIN->value,
    ]);

    $regularUsersCount = User::where('role', RoleEnum::REGULAR)->count();
    expect($regularUsersCount)->toBe(10);
});
