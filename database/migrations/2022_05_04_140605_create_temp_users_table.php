<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('temp_users', function (Blueprint $table) {
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
      $table->string('jenis_kelamin')->nullable();
      $table->string('tempat_lahir')->nullable();
      $table->date('tanggal_lahir')->nullable();
      $table->string('nik')->nullable();
      $table->string('nip')->nullable();
      $table->string('pangkat')->nullable();
      $table->date('tmt_pangkat')->nullable();
      $table->string('golongan')->nullable();
      $table->date('tmt_golongan')->nullable();
      $table->date('tgl_awal_pengangkatan')->nullable();
      $table->string('status_kepegawaian')->nullable();
      $table->string('file_ktp')->nullable();
      $table->string('file_sk_terakhir')->nullable();
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
    Schema::dropIfExists('temp_users');
  }
}
