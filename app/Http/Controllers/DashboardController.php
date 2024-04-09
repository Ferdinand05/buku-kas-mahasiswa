<?php

namespace App\Http\Controllers;

use App\Models\KategoriTransaksi;
use App\Models\Mahasiswa;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $bulan = date('m');

        return view(
            'dashboard.index',
            [
                'mahasiswa' => Mahasiswa::count(),
                'user' => User::count(),
                'totalTransaksi' => Transaksi::where('jenis', 'Pemasukan')->whereMonth('created_at', $bulan)->sum('total'),
                'transaksi' => Transaksi::count()
            ]
        );
    }
}
