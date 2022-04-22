<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $values = [
        ['role' => 'Administrator'],
        ['role' => 'PIC'],
        ['role' => 'User'],
      ];

      DB::table('roles')->insert($values);
    }
}
