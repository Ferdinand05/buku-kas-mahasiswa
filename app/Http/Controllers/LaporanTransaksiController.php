<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanTransaksiController extends Controller
{
    public function index()
    {

        $pemasukan = Transaksi::where('jenis', 'Pemasukan')->orderBy('created_at', 'desc')->get();
        $pengeluaran = Transaksi::where('jenis', 'Pengeluaran')->orderBy('created_at', 'desc')->get();

        return view(
            'laporanTransaksi.index',
            [
                'pemasukan' => $pemasukan,
                'pengeluaran' => $pengeluaran
            ]
        );
    }

    public function printPDF(Request $request)
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

        $pdf = PDF::loadView('laporanTransaksi.transaksiPDF', ['pemasukan' => $pemasukan, 'pengeluaran' => $pengeluaran, 'tanggal_awal' => $tanggal_awal, 'tanggal_akhir' => $tanggal_akhir]);
        return $pdf->download('laporan_transaksi.pdf');
    }

    public function exportExcel(Request $request)
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
        return Excel::download(new TransaksiExport($pemasukan, $pengeluaran), 'transaksi.xlsx');
    }
}
