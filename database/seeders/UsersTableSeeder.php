<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@imperialspice.com',
                'phone' => '9999999999',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@imperialspice.com',
                'phone' => '8888888888',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delivery Guy',
                'email' => 'delivery@imperialspice.com',
                'phone' => '7777777777',
                'password' => Hash::make('password'),
                'role' => 'delivery',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
