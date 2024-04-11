<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyTransaksiChart;
use App\Charts\TransaksiChart;
use App\Models\KategoriTransaksi;
use App\Models\Mahasiswa;
use App\Models\Transaksi;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;
use ArielMejiaDev\LarapexCharts\LarapexChart as LarapexChartsLarapexChart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $bulan = date('m');
        $namaBulan = date('F', mktime(0, 0, 0, $bulan, 1, Carbon::now()->year));
        $pemasukan = Transaksi::where('jenis', 'Pemasukan')->whereMonth('created_at', $bulan)->sum('total');
        $pengeluaran = Transaksi::where('jenis', 'Pengeluaran')->whereMonth('created_at', $bulan)->sum('total');
        $selisih = $pemasukan - $pengeluaran;


        $chart = new TransaksiChart;
        $chart->title('Perbandingan Pemasukan & Pengeluaran Bulan ' . $namaBulan, 15, '#237');
        $chart->labels(['Pemasukan', 'Pengeluaran', 'Selisih']);
        $chart->dataset('Total', 'pie', [$pemasukan, $pengeluaran, $selisih])->backgroundColor(['lightblue', 'salmon', 'lightgreen']);




        // pemasukan & pengeluaran bulanan
        $bulanIni = $bulan;
        $satu_bulan_lalu = $bulan - 1;
        $dua_bulan_lalu =  $satu_bulan_lalu - 1;

        $namaBulan_ini = date('F', mktime(0, 0, 0, $bulanIni, 1, Carbon::now()->year));
        $namaBulan_satu = date('F', mktime(0, 0, 0, $satu_bulan_lalu, 1, Carbon::now()->year));
        $namaBulan_dua = date('F', mktime(0, 0, 0, $dua_bulan_lalu, 1, Carbon::now()->year));
        $pemasukanBulanIni = Transaksi::where('jenis', 'Pemasukan')->whereMonth('created_at', $bulanIni)->sum('total');
        $pemasukan_satu_bulan_lalu = Transaksi::where('jenis', 'Pemasukan')->whereMonth('created_at', $satu_bulan_lalu)->sum('total');
        $pemasukan_dua_bulan_lalu = Transaksi::where('jenis', 'Pemasukan')->whereMonth('created_at', $dua_bulan_lalu)->sum('total');
        $chart2 = new MonthlyTransaksiChart;
        $chart2->title('Pemasukan 3 Bulan Terakhir', 15, '#237');
        $chart2->labels([$namaBulan_dua, $namaBulan_satu, $namaBulan_ini]);
        $chart2->displayAxes(true);
        $chart2->dataset('Total', 'bar', [$pemasukan_dua_bulan_lalu, $pemasukan_satu_bulan_lalu, $pemasukanBulanIni])->backgroundColor(['red', 'green', 'blue']);
        return view(
            'dashboard.index',
            [
                'mahasiswa' => Mahasiswa::count(),
                'user' => User::count(),
                'totalTransaksi' => $pemasukan,
                'transaksi' => Transaksi::count(),
                'chart' => $chart,
                'chart2' => $chart2
            ]
        );
    }
}
