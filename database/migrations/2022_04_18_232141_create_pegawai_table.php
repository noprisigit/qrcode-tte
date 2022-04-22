<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaiTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('pegawai', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained();
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
    Schema::dropIfExists('pegawai');
  }
}
