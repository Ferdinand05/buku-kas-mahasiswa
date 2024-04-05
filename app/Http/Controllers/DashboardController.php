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
        return view(
            'dashboard.index',
            [
                'mahasiswa' => Mahasiswa::count(),
                'user' => User::count(),
                'kategoritransaksi' => KategoriTransaksi::count(),
                'transaksi' => Transaksi::count()
            ]
        );
    }
}
