<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
  use HasFactory;

  protected $table = 'sub_bidang';
  protected $fillable = ['nama', 'dinas_id'];

  public function dinas()
  {
    return $this->belongsTo(Dinas::class, 'dinas_id');
  }
}
