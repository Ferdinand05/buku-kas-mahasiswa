<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;
    protected $table = 'transaksi';
    protected $primaryKey = 'kode_transaksi';
    public $incrementing = false;
    protected $fillable = ['kode_transaksi', 'nim_mahasiswa', 'total', 'user_id', 'jenis', 'id_kategori_transaksi'];


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['kode_transaksi', 'jenis', 'mahasiswa.nama', 'kategoriTransaksi.nama', 'users.name', 'total'])
            ->setDescriptionForEvent(fn (string $eventName) => "This new Transaksi has been {$eventName}")
            ->useLogName('Transaksi');
        // Chain fluent methods for configuration options
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim_mahasiswa');
    }

    public function kategoriTransaksi()
    {
        return $this->belongsTo(KategoriTransaksi::class, 'id_kategori_transaksi');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
