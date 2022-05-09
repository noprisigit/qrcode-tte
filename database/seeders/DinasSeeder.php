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
          'id' => 1,
          'nama' => 'Dinas Kesehatan',
        ],
        [
          'id' => 2,
          'nama' => 'Dinas Pendidikan',
        ],
        [
          'id' => 3,
          'nama' => 'Dinas Komunikasi dan Informatika',
        ]
      ];

      DB::table('dinas')->insert($values);
    }
}
