<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempUser extends Model
{
  use HasFactory;

  protected $fillable = ['nama', 'email', 'password', 'unique_code', 'no_telp', 'dinas_id', 'sub_bidang_id', 'role_id', 'avatar', 'status', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'nik', 'nip', 'pangkat', 'golongan', 'file_ktp', 'file_sk_terakhir'];

  public function dinas()
  {
    return $this->belongsTo(Dinas::class);
  }

  public function bidang()
  {
    return $this->belongsTo(Bidang::class, 'sub_bidang_id', 'id');
  }
}
