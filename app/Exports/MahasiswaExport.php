<?php

namespace App\Exports;

use App\Models\JurusanMahasiswa;
use App\Models\Mahasiswa;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class MahasiswaExport implements FromView
{
    private $jurusan;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($jurusan)
    {
        $this->jurusan = $jurusan;
    }


    public function view(): View
    {

        $namaJurusan = JurusanMahasiswa::find($this->jurusan);
        if ($this->jurusan) {
            $data = Mahasiswa::where('id_jurusan_mahasiswa', $this->jurusan)->orderBy('created_at', 'desc')->get();
        } else {
            $data = Mahasiswa::orderBy('created_at', 'desc')->get();
        }

        return view('laporanMahasiswa.mahasiswaExcel', ['mahasiswa' => $data, 'jurusan' => $namaJurusan]);
    }
}
