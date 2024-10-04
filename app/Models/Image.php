<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        // 'mime_type',
        'path',
        'disk',
        // 'size',
    ];

    public static function getFileNameById($id)
    {
        return self::where("id", $id)->first();
    }

    public static function getIdByFilename($filename)
    {
        return self::where("file_name", $filename)->first()->id;
    }

    public static function getPathFileByDataPendaftarId($dataPendaftarId)
    {
       return DB::table('users')
        ->join('data_pendaftar', 'users.data_pendaftar_id', '=', 'data_pendaftar.id') // Join dengan data_pendaftar
        ->join('files', 'data_pendaftar.ktp_id', '=', 'files.id') // Join dengan files
        ->where('data_pendaftar.id', $dataPendaftarId) // Kondisi untuk data_pendaftar
        ->select('files.path') // Pilih kolom yang diinginkan
        ->first();
    }

    public static function getKKPathByDataPendaftarId($dataPendaftarId)
{
    return DB::table('users')
        ->join('data_pendaftar', 'users.data_pendaftar_id', '=', 'data_pendaftar.id') // Join with data_pendaftar
        ->join('files', 'data_pendaftar.kartu_keluarga_id', '=', 'files.id') // Join with files using KK ID
        ->where('data_pendaftar.id', $dataPendaftarId) // Condition for data_pendaftar
        ->select('files.path') // Select the file path for KK
        ->first();
}
}
