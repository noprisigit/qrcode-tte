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
      [
        'id' => 1,
        'role' => 'Administrator'
      ],
      [
        'id' => 2,
        'role' => 'PIC'
      ],
      [
        'id' => 3,
        'role' => 'User'
      ],
    ];

    DB::table('roles')->insert($values);
  }
}
