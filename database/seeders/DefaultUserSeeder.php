<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // check if there's an existing user by email
            ['name' => 'John Doe',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            ]
        );

        // check if role already exist to avoid duplicate values in roles
        $roleAdmin = Role::firstOrCreate([
            'role_name' => 'ADMIN',
            'description' => 'SUPER USER',
        ]);

        // check if user role already exist to avoid duplicate values in user roles
        UserRole::firstOrCreate([
            'user_id' => $admin->id,
            'role_id' => $roleAdmin->id,
        ]);

        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            ['name' => 'Kyle Panctual',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user'),
            ]
        );

        // check if role already exist to avoid duplicate values in roles
        $roleUser = Role::firstOrCreate([
            'role_name' => 'USER',
            'description' => 'Can create expenses',
        ]);

        // check if user role already exist to avoid duplicate values in user roles
        UserRole::firstOrCreate([
            'user_id' => $user->id,
            'role_id' => $roleUser->id,
        ]);

    }
}
