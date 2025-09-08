<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create admin user
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('Admin@123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create test users
        $testUsers = [
            [
                'name' => 'Ozzy Osbourne',
                'email' => 'oosbourne@test.com',
                'password' => Hash::make('Test@12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Angus Young',
                'email' => 'ayoung@test.com',
                'password' => Hash::make('Test@12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dave Lombardo',
                'email' => 'dlombardo@test.com',
                'password' => Hash::make('Test@12345'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];

        DB::table('users')->insert($testUsers);
    }
}
