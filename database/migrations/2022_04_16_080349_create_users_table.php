<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->id();
      $table->string('nama');
      $table->string('email')->unique();
      $table->string('password');
      $table->string('unique_code')->unique();
      $table->string('no_telp')->nullable();
      $table->unsignedBigInteger('dinas_id')->nullable();
      $table->unsignedBigInteger('sub_bidang_id')->nullable();
      $table->unsignedBigInteger('role_id')->nullable();
      $table->string('avatar')->nullable();
      $table->tinyInteger('status');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('users');
  }
}
