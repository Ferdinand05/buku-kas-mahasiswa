<?php

namespace App\Http\Controllers;

use App\Models\KategoriTransaksi;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator as ValidationValidator;

class KategoriTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('kategoriTransaksi.index', ['kategoritransaksi' => KategoriTransaksi::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'view' => view('kategoriTransaksi._create')->render()
        ];
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $nama = $request->post('nama');
            $keterangan = $request->post('keterangan');

            $validator = validator()->make(
                [
                    'nama' => $nama,
                    'keterangan' => $keterangan
                ],
                [
                    'nama' => 'required|string|min:3',
                    'keterangan' => 'required|string'
                ]
            );

            if ($validator->fails()) {
                $json = [
                    'error' => $validator->errors()->getMessages()
                ];
            } else {

                KategoriTransaksi::create([
                    'nama' => $nama,
                    'keterangan' => $keterangan
                ]);

                $json = [
                    'success' => 'Kategori Transaksi berhasil ditambahkan!'
                ];
            }




            return response()->json($json);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriTransaksi $kategoriTransaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $json = [
            'data' => view(
                'kategoriTransaksi._edit',
                ['data' => KategoriTransaksi::find($request->id_kategori)]
            )->render()
        ];

        return response()->json($json);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $nama = $request->nama;
        $keterangan = $request->keterangan;
        $id_kategoriTransaksi = $request->id_kategori;
        $validator = validator()->make(
            [
                'nama' => $nama,
                'keterangan' => $keterangan
            ],
            [
                'nama' => 'required|string|min:3',
                'keterangan' => 'required|string'
            ]
        );

        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {

            KategoriTransaksi::where('id', $id_kategoriTransaksi)->update([
                'nama' => $nama,
                'keterangan' => $keterangan
            ]);

            $json = [
                'success' => 'Kategori Transaksi berhasil di Edit!'
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
            $id_kategoriTransaksi = $request->id_kategori;

            KategoriTransaksi::destroy($id_kategoriTransaksi);
            $json = [
                'success' => 'Data berhasil dihapus!'
            ];
        } else {
            exit('404');
        }

        return response()->json($json);
    }
}
