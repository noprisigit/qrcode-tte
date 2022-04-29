<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
  use HasFactory;

  protected $table = 'pegawai';
  protected $fillable = [
    'user_id',
    'tempat_lahir',
    'tanggal_lahir',
    'jenis_kelamin',
    'nik',
    'nip',
    'pangkat',
    'tmt_pangkat',
    'golongan',
    'tmt_golongan',
    'tgl_awal_pengangkatan',
    'status_kepegawaian',
  ];

  public function getTanggalIndonesia($value, $html = false)
  {
    if (!$html) return $value;

    return Carbon::create($value)->isoFormat('D MMMM Y');
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
