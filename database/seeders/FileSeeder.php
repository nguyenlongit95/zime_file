<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("files")->insert([
            ['user_id' => 11, "name" => "new2", 'file_size' => 12],
            ['user_id' => 11, "name" => "new1", 'file_size' => 12],
        ]);
    }
}
