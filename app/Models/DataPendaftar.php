<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use App\Models\Agama;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\GolonganDarah;
use App\Models\KartuKeluarga;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPendaftar extends Model
{
    use HasFactory;

    protected $table = 'data_pendaftar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'terverifikasi',
        'user_id',
        'nomor_induk_kependudukan',
        // 'kartu_keluarga_id',
        'tempat_lahir',
        'tanggal_lahir',
        'anggota_keluarga_id',
        'nomor_telepon',
        'kelurahan_id',
        'kecamatan_id',
        'rt',
        // 'ktp_id',
        'rw',
        'kelamin',
        'golongan_darah_id',
        'agama_id',
        'status_nikah',
        'kewarganegaraan',
        'alamat',
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

    // protected static function booted()
    // {
    //     static::saving(function ($dataPendaftar) {
    //         // Check if a nomor KK was provided
    //         if (isset($dataPendaftar->kartu_keluarga_nomor)) {
    //             // Create a new entry in the kartu_keluarga table
    //             $kartuKeluarga = KartuKeluarga::create([
    //                 'nomor' => $dataPendaftar->kartu_keluarga_nomor,
    //                 // 'files_id' => null, // Set other default values if necessary
    //             ]);

    //             // Assign the newly created kartu_keluarga_id to DataPendaftar
    //             $dataPendaftar->kartu_keluarga_id = $kartuKeluarga->id;
    //         }
    //     });
    // }

    public function ktp() {
        return $this->belongsTo(Files::class, "ktp_id");
    }

    public static function getDataPendaftarIdByEmail(string $email)
    {
        return self::select('id')->where('email', $email)->first();
    }

    public function kartuKeluarga()
    {
        return $this->belongsTo(KartuKeluarga::class, 'kartu_keluarga_id');
    }

    public function golonganDarah()
    {
        return $this->belongsTo(GolonganDarah::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, "role_id");
    }


    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id');
    }

    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class, 'kelurahan_id');
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function anggota_keluarga()
    {
        return $this->belongsTo(AnggotaKeluarga::class, "anggota_keluarga_id");
    }

    public static function updateKtpId($ktpId, $dataPendaftarId) {
        return self::where("id", $dataPendaftarId)->update(["ktp_id", $ktpId]);
    }


    public function kartu_keluarga() {
        return $this->belongsTo(KartuKeluarga::class, "kartu_keluarga_id");
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}