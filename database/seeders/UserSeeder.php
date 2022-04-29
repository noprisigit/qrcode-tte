<?php

namespace Database\Seeders;

use App\Http\Controllers\HelperController;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
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
          'nama' => 'Admin',
          'email' => 'admin@gmail.com',
          'unique_code' => HelperController::generateUniqueCode(),
          'password' => Hash::make('admin'),
          'dinas_id' => 1,
          'sub_bidang_id' => 2,
          'role_id' => User::ROLE_ADMIN,
          'status' => User::STATUS_ACTIVE
        ],
        [
          'nama' => 'PIC',
          'email' => 'pic@gmail.com',
          'unique_code' => HelperController::generateUniqueCode(),
          'password' => Hash::make('pic'),
          'dinas_id' => 1,
          'sub_bidang_id' => 2,
          'role_id' => User::ROLE_PIC,
          'status' => User::STATUS_ACTIVE
        ],
        [
          'nama' => 'User',
          'email' => 'user@gmail.com',
          'unique_code' => HelperController::generateUniqueCode(),
          'password' => Hash::make('user'),
          'dinas_id' => 1,
          'sub_bidang_id' => 2,
          'role_id' => User::ROLE_USER,
          'status' => User::STATUS_ACTIVE
        ],
      ];

      DB::table('users')->insert($values);
    }
}
