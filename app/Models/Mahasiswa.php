<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Mahasiswa extends Model
{
    use HasFactory, LogsActivity;

    protected $table = 'mahasiswa';
    protected $primaryKey = 'nim';
    protected $fillable = ['nim', 'nama', 'alamat', 'no_telp', 'id_jurusan_mahasiswa'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['nim', 'nama', 'alamat', 'no_telp', 'jurusanMahasiswa.jurusan'])->setDescriptionForEvent(fn (string $eventName) => "This new Mahasiswa has been {$eventName}")
            ->useLogName('Mahasiswa');
        // Chain fluent methods for configuration options
    }


    public function jurusanMahasiswa()
    {
        return $this->belongsTo(JurusanMahasiswa::class, 'id_jurusan_mahasiswa');
    }
}
