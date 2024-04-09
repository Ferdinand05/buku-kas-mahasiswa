<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class RekapitulasiController extends Controller
{
    public function index()
    {

        $pengeluaran = Transaksi::where('jenis', 'Pengeluaran')->get();
        $pemasukan = Transaksi::where('jenis', 'Pemasukan')->get();

        return view('rekapitulasi.index', ['pengeluaran' => $pengeluaran, 'pemasukan' => $pemasukan]);
    }

    public function tableRekapitulasi(Request $request)
    {

        $tanggal_awal = $request->tanggal_awal;
        $tanggal_akhir = $request->tanggal_akhir;
        if ($tanggal_awal && $tanggal_akhir) {

            $pengeluaran = Transaksi::where('jenis', 'Pengeluaran')->whereDate('created_at', '>=', $tanggal_awal)->whereDate('created_at', '<=', $tanggal_akhir)->get();
            $pemasukan = Transaksi::where('jenis', 'Pemasukan')->whereDate('created_at', '>=', $tanggal_awal)->whereDate('created_at', '<=', $tanggal_akhir)->get();
        } else if ($tanggal_awal) {
            $pengeluaran = Transaksi::where('jenis', 'Pengeluaran')->whereDate('created_at', '=', $tanggal_awal)->get();
            $pemasukan = Transaksi::where('jenis', 'Pemasukan')->whereDate('created_at', '=', $tanggal_awal)->get();
        } else {
            $pengeluaran = Transaksi::where('jenis', 'Pengeluaran')->get();
            $pemasukan = Transaksi::where('jenis', 'Pemasukan')->get();
        }



        $json = [
            'data' => view('rekapitulasi._tableRekapitulasi', ['pengeluaran' => $pengeluaran, 'pemasukan' => $pemasukan])->render()
        ];

        return response()->json($json);
    }
}
