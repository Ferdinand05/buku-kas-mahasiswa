<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class KategoriTransaksi extends Model
{
    use HasFactory, LogsActivity;
    protected $table = 'kategori_transaksi';
    protected $primaryKey = 'id';
    protected $fillable = ['nama', 'keterangan'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
        // Chain fluent methods for configuration options
    }
}
