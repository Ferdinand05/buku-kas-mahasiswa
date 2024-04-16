<?php

namespace App\Http\Controllers;

use App\Charts\TransaksiChart;
use App\Models\KategoriTransaksi;
use App\Models\Mahasiswa;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {

            $data = Transaksi::join('mahasiswa', 'mahasiswa.nim', '=', 'nim_mahasiswa')->whereAny(['kode_transaksi', 'transaksi.created_at', 'total', 'nim_mahasiswa', 'mahasiswa.nama'], 'LIKE', "%$keyword%")->paginate();
        } else {
            $data = Transaksi::orderBy('created_at', 'desc')->paginate(9);
        }

        return view('transaksi.index', ['transaksi' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {
            $json = [
                'view' => view(
                    'transaksi._create',
                    [
                        'mahasiswa' => Mahasiswa::orderBy('nama', 'asc')->get(),
                        'users' => User::all(),
                        'kategoriTransaksi' => KategoriTransaksi::all()
                    ]
                )->render()
            ];
        }

        return response()->json($json);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'user' => $request->user,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'kategori_transaksi' => $request->kategori_transaksi,
                'jenis_transaksi' => $request->jenis_transaksi,
                'total' => $request->total
            ],
            [
                'user' => 'required',
                'nama_mahasiswa' => 'required',
                'kategori_transaksi' => 'required',
                'jenis_transaksi' => 'required',
                'total' => 'min_digits:3|required'
            ]
        );

        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {

            $prefix = 'INV-';
            $date = date('ymd');
            $randomNumber = rand(1000, 9999);
            $kodeTransaksi = $prefix . $date . $randomNumber;


            Transaksi::create([
                'kode_transaksi' => $kodeTransaksi,
                'nim_mahasiswa' => $request->nama_mahasiswa,
                'total' => $request->total,
                'user_id' => $request->user,
                'jenis' => $request->jenis_transaksi,
                'id_kategori_transaksi' => $request->kategori_transaksi
            ]);


            $json = [
                'success' => 'Transaksi berhasil disimpan'
            ];
        }


        return response()->json($json);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $json = [
            'view' => view(
                'transaksi._show',
                ['transaksi' => Transaksi::where('kode_transaksi', $request->kode_transaksi)->get()]
            )->render()
        ];

        return response()->json($json);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if ($request->ajax()) {

            $json = [
                'view' => view(
                    'transaksi._edit',
                    [
                        'transaksi' => Transaksi::where('kode_transaksi', $request->kode_transaksi)->first(),
                        'mahasiswa' => Mahasiswa::all(),
                        'users' => User::all(),
                        'kategoriTransaksi' => KategoriTransaksi::all()
                    ]
                )
                    ->render()
            ];
        }

        return response()->json($json);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            [
                'user' => $request->user,
                'nama_mahasiswa' => $request->nama_mahasiswa,
                'kategori_transaksi' => $request->kategori_transaksi,
                'jenis_transaksi' => $request->jenis_transaksi,
                'total' => $request->total
            ],
            [
                'user' => 'required',
                'nama_mahasiswa' => 'required',
                'kategori_transaksi' => 'required',
                'jenis_transaksi' => 'required',
                'total' => 'min_digits:3|required',
            ]
        );

        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {

            Transaksi::where('kode_transaksi', $request->kode_transaksi)->update([
                'nim_mahasiswa' => $request->nama_mahasiswa,
                'total' => $request->total,
                'user_id' => $request->user,
                'jenis' => $request->jenis_transaksi,
                'id_kategori_transaksi' => $request->kategori_transaksi
            ]);

            $model = Transaksi::find($request->kode_transaksi);
            activity()->causedBy(auth()->user()->id)->performedOn($model)->event('Updated')->log('Updated ' . $request->kode_transaksi);
            $json = [
                'success' => 'Transaksi berhasil disimpan'
            ];
        }

        return response()->json($json);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if ($request->ajax()) {
            Transaksi::destroy($request->kode_transaksi);

            $json = [
                'success' => 'Data Transaksi berhasil Dihapus!'
            ];
        }

        return response()->json($json);
    }

    public function softdelete(Request $request)
    {
        if ($request->ajax()) {
            $transaksi = Transaksi::whereNull('deleted_at')->get();

            activity()->causedBy(auth()->user()->id)->useLog('Softdelete')->event('Softdelete')
                ->log('Softdeletes all transaction!');

            foreach ($transaksi as $data) {
                $data->delete();
            }



            $json = [
                'success' => 'Semua data transaksi telah dihapus!'
            ];
        }

        return response()->json($json);
    }


    public function restore(Request $request)
    {
        if ($request->ajax()) {
            $transaksi = Transaksi::whereNotNull('deleted_at')->restore();

            activity()->causedBy(auth()->user()->id)->useLog('Restore')->event('Restore')
                ->log('Restored all transaction!');

            $json = [
                'success' => 'Semua data transaksi telah Dikembalikan!'
            ];
        }

        return response()->json($json);
    }
}
