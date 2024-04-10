<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\JurusanMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class LaporanMahasiswaController extends Controller
{
    public function index()
    {

        return view(
            'laporanMahasiswa.index',
            [
                'mahasiswa' => Mahasiswa::orderBy('created_at', 'desc')->get(),
                'jurusan' => JurusanMahasiswa::all()
            ]
        );
    }


    public function printPDF(Request $request)
    {

        $jurusan = $request->post('filter_jurusan');
        $namaJurusan = JurusanMahasiswa::find($jurusan);
        if ($jurusan) {
            $data = Mahasiswa::where('id_jurusan_mahasiswa', $jurusan)->orderBy('created_at', 'desc')->get();
        } else {
            $data = Mahasiswa::orderBy('created_at', 'desc')->get();
        }

        $pdf = PDF::loadView('laporanMahasiswa.mahasiswaPDF', ['mahasiswa' => $data, 'jurusan' => $namaJurusan]);
        return $pdf->download('laporan_mahasiswa.pdf');
    }
}
