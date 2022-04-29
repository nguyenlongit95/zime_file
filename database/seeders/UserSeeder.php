<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin record
        DB::table('users')->insert([
            'name' => 'Admin',
            'package_id' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '1234567890',
            'role' => 0,
            'created_at' => new \DateTime('1st January 2022')
        ]);
        // User record
        for($i = 1; $i <= 100; $i++) {
            DB::table('users')->insert([
                'name' => 'user'. $i,
                'package_id' => rand(1, 4),
                'email' => 'user' . $i . '@gmail.com',
                'password' => Hash::make('12345678'),
                'phone' => '1234567890',
                'role' => 1,
                'created_at' => new \DateTime('1st March 2022')
            ]);
        }
    }
}
