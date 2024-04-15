<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JurusanMahasiswa extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'jurusan_mahasiswa';
    protected $primaryKey = 'id';
    protected $fillable = ['jurusan'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
        // Chain fluent methods for configuration options
    }


    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'id_jurusan_mahasiswa');
    }
}
