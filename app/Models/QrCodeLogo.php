<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodeLogo extends Model
{
    use HasFactory;

    protected $table = 'logo_qrcode';
    protected $fillable = ['user_id', 'logo'];
}
