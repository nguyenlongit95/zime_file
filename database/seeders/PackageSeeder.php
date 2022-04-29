<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("packages")->insert([
            ['name' => 'Basic', "max_file_upload" => 4, 'max_file_size' => 64, 'created_at' => new \DateTime('1st March 2022')],
            ['name' => 'Normal', "max_file_upload" => 10, 'max_file_size' => 128, 'created_at' => new \DateTime('1st March 2022')],
            ['name' => 'Vip', "max_file_upload" => 30, 'max_file_size' => 512, 'created_at' => new \DateTime('1st March 2022')],
            ['name' => 'Expert', "max_file_upload" => 50, 'max_file_size' => 2048, 'created_at' => new \DateTime('1st March 2022')]
        ]);
    }
}
