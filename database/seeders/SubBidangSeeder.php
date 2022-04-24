<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubBidangSeeder extends Seeder
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
          'dinas_id' => 1,
          'nama' => 'Administrasi Umum',
        ],
        [
          'dinas_id' => 1,
          'nama' => 'Keuangan',
        ]
      ];

      DB::table('sub_bidang')->insert($values);
    }
}
