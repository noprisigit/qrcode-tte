<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tte extends Model
{
    use HasFactory;

    protected $table = 'tte';
    protected $fillable = ['user_id', 'qrcode', 'tte'];
}
