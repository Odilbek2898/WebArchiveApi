<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CellTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++){
            $cName = 'Ячейка #'.$i;
            $boxId = ($i < 10) ? rand(1, 10) : 1;

            $cells[] = [
                'name' => $cName,
                'box_id' => $boxId
            ];
        }

        DB::table('cells')->insert($cells);
    }
}
