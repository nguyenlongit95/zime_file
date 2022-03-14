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
        //
        DB::table("packages")->insert([
           'name' => 'Basic',
            "max_file_upload" => 4,
            'max_file_size' => 64,
        ]);
    }
}
