<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  const ROLE_ADMIN = 1;
  const ROLE_PIC = 2;
  const ROLE_USER = 3;

  const STATUS_ACTIVE = 1;
  const STATUS_INACTIVE = 2;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'nama',
    'email',
    'password',
    'role_id',
    'unique_code',
    'avatar',
    'status',
    'no_telp',
    'dinas_id',
    'sub_bidang_id',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
  ];

  // public function role()
  // {
  //   return $this->belongsTo(Role::class);
  // }

  public static function getRoleName($index = null, $html = false)
  {
    $array = [
      self::ROLE_ADMIN => 'Administrator',
      self::ROLE_PIC => 'PIC',
      self::ROLE_USER => 'User',
    ];

    if ($html) {
      $array = [
        self::ROLE_ADMIN => '<span class="badge badge-primary">Administrator</span>',
        self::ROLE_PIC => '<span class="badge badge-info">PIC</span>',
        self::ROLE_USER => '<span class="badge badge-secondary">User</span>',
      ];
    }

    if ($index == null) return $array;
    if (isset($array[$index])) return $array[$index];
    return null;
  }

  public static function getStatus($index = null, $html = false)
  {
    $array = [
      self::STATUS_ACTIVE => 'Aktif',
      self::STATUS_INACTIVE => 'Tidak Aktif'
    ];

    if ($html) {
      $array = [
        self::STATUS_ACTIVE => '<span class="badge badge-success">Aktif</span>',
        self::STATUS_INACTIVE => '<span class="badge badge-danger">Tidak Aktif</span>'
      ];
    }

    if ($index == null) return $array;
    if (isset($array[$index])) return $array[$index];
    return null;
  }

  public function dinas()
  {
    return $this->belongsTo(Dinas::class);
  }

  public function bidang()
  {
    return $this->belongsTo(Bidang::class, 'sub_bidang_id', 'id');
  }

  public function verifikasi_pegawai()
  {
    return $this->hasMany(VerifikasiPegawai::class);
  }

  public function pegawai()
  {
    return $this->hasOne(Pegawai::class);
  }
}
