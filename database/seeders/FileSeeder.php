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
        $num = 0;
        for($i = 1; $i <= 30; $i++) {
            for($j = 1; $j <= rand(0,500); $j++) {
                $num ++;
                DB::table("files")->insert([
                    'user_id' => rand(2,101),
                    "name" => "new" . $num,
                    'file_size' => 12,
                    'created_at' => new \DateTime($i.'st April 2022'),
                ]);
            }
        }
    }
}
