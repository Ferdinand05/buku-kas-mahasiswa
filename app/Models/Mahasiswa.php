<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $fillable = ['nim', 'nama', 'alamat', 'no_telp', 'id_jurusan_mahasiswa'];

    public function jurusanMahasiswa()
    {
        return $this->belongsTo(JurusanMahasiswa::class, 'id_jurusan_mahasiswa');
    }
}