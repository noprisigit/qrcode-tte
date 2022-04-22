<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiPegawai extends Model
{
  use HasFactory;

  const STATUS_WAITING = 0;
  const STATUS_ACCEPTED = 1;
  const STATUS_REJECTED = 2;

  protected $table = 'verifikasi_pegawai';
  protected $fillable = ['user_id', 'label', 'type', 'name', 'value', 'status'];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
