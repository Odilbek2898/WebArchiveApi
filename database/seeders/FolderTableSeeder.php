<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FolderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++){
            $cName = 'Папка #'.$i;
            $cellId = ($i < 5) ? rand(1, 5) : 1;

            $folders[] = [
                'name' => $cName,
                'cell_id' => $cellId
            ];
        }

        DB::table('folders')->insert($folders);
    }
}
