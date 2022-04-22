<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinas extends Model
{
  use HasFactory;

  protected $fillable = [
    'nama',
  ];

  public function getName()
  {
    return $this->nama;
  }
}
