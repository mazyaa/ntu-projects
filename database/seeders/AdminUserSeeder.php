<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Create the default Super Admin user from environment variables.
     * Falls back to safe local defaults; never hardcodes production secrets.
     */
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $name = env('ADMIN_NAME');
        $password = env('ADMIN_PASSWORD');

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'email_verified_at' => now(),
            ]
        );

        if (! $user->hasRole('Super Admin')) {
            $user->assignRole(Role::where('name', 'Super Admin')->firstOrFail());
        }
    }
}
