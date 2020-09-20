<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 200; $i++){
            $cName = 'Файл #'.$i;
            $folderId = ($i < 50) ? rand(1, 50) : 1;

            $files[] = [
                'name' => $cName,
                'folder_id' => $folderId
            ];
        }

        DB::table('files')->insert($files);
    }
}
