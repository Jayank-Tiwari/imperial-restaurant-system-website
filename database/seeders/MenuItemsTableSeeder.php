<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('menu_items')->insert([
            [
                'name' => 'Butter Chicken',
                'description' => 'Classic North Indian dish with creamy tomato gravy',
                'category' => 'Main Course',
                'price' => 320.00,
                'availability' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Paneer Tikka',
                'description' => 'Grilled paneer cubes with spices',
                'category' => 'Starter',
                'price' => 250.00,
                'availability' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
