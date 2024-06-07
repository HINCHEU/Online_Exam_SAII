<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Factory;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        // Role::factory()->create([
        //     'name' => 'Admin'
        // ]);
        // Role::factory()->create([
        //     'name' => 'Teacher'
        // ]);
        // Role::factory()->create([
        //     'name' => 'Student'
        // ]);

        //Teacher User
        User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher@exam.com',
            'role_id' => '2',
            'email_verified_at' => '2024-05-29 06:11:1',
            'password' => Hash::make('password')

        ]);
        //admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@exam.com',
            'role_id' => '1',
            'email_verified_at' => '2024-05-29 06:11:1',
            'password' => Hash::make('password'),
        ]);
        //Student
        User::factory()->create([
            'name' => 'student',
            'email' => 'student@exam.com',
            'role_id' => '3',
            'email_verified_at' => '2024-05-29 06:11:1',
            'password' => Hash::make('password'),
        ]);
    }
}
