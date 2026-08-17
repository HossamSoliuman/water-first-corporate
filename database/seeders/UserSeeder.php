<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Creates the admin account `/admin` is locked behind.
     *
     * Keyed on the email so re-running `db:seed` over an existing database is a
     * no-op rather than a unique-index violation — and so a password changed
     * after seeding is not silently reset back to the default.
     */
    public function run(): void
    {
        $password = 'password';

        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make($password),
                'is_admin' => true,
            ]
        );

        if (! $user->wasRecentlyCreated) {
            $this->command?->info('Admin user already exists: admin@example.com');

            return;
        }

        $this->command?->info('Admin user created.');
        $this->command?->info('Email: admin@example.com');
        $this->command?->info("Password: {$password}");
    }
}
