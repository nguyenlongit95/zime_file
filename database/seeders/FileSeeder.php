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
            'user_id' => 1,
            "name" => "new",
            'file_size' => 12,
        ]);
    }
}
