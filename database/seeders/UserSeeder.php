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
            'role' => 0
        ]);
        // User01 record
        DB::table('users')->insert([
            'name' => 'user01',
            'package_id' => 1,
            'email' => 'user01@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '1234567890',
            'role' => 1
        ]);
    }
}
