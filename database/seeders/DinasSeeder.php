<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $values = [
        [
          'nama' => 'Dinas Kesehatan',
        ],
        [
          'nama' => 'Dinas Pendidikan',
        ],
        [
          'nama' => 'Dinas Komunikasi dan Informatika',
        ]
      ];

      DB::table('dinas')->insert($values);
    }
}
