<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurusanMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'jurusan_mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = ['jurusan'];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_jurusan_mahasiswa');
    }
}
