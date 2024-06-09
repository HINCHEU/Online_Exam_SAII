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
        $this->call(RolesSeeder::class);

        //Teacher User
        User::factory()->create([
            'name' => 'Teacher',
            'email' => 'teacher@exam.com',
            'role_id' => 3,
            'email_verified_at' => '2024-05-29 06:11:1',
            'password' => Hash::make('password'),
            'status' => 1


        ]);
        //admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@exam.com',
            'role_id' => 1,
            'email_verified_at' => '2024-05-29 06:11:1',
            'password' => Hash::make('password'),
            'status' => 1

        ]);
        //Student
        User::factory()->create([
            'name' => 'student',
            'email' => 'student@exam.com',
            'role_id' => 2,
            'email_verified_at' => '2024-05-29 06:11:1',
            'password' => Hash::make('password'),
            'status' => 1

        ]);
    }
}
