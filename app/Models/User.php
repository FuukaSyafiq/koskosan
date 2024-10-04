<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Agama;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\DataPendaftar;
use App\Models\GolonganDarah;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'nomor_induk_kependudukan',
        'role_id',
        'data_pendaftar_id',
        "password",
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public static function getIdByName($name)
    {
        return self::where('name', $name)->first('id')->id;
    }

    public function dataPendaftar()
    {
        return $this->hasOne(DataPendaftar::class, 'data_pendaftar_id');
    }

}
