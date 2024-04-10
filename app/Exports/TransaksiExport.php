<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
    use Exportable;
    private $pemasukan, $pengeluaran;
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($pemasukan, $pengeluaran)
    {
        $this->pemasukan = $pemasukan;
        $this->pengeluaran = $pengeluaran;
    }



    public function view(): View
    {
        $data = Transaksi::all();
        return view('laporanTransaksi.transaksiExcel', [
            'pemasukan' => $this->pemasukan,
            'pengeluaran' => $this->pengeluaran
        ]);
    }
}
