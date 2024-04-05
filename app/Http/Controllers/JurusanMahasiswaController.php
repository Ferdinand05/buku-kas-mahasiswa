<?php

namespace App\Http\Controllers;

use App\Models\JurusanMahasiswa;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JurusanMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('jurusanMahasiswa.index', ['jurusan' => JurusanMahasiswa::paginate(5)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'view' => view('jurusanMahasiswa._create')->render()
        ];

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $namaJurusan = $request->nama_jurusan;
        $validator = validator()->make([
            'nama' => $namaJurusan
        ], [
            'nama' => ['required', 'min:3', 'string']
        ]);

        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {

            JurusanMahasiswa::create([
                'nama' => $request->nama_jurusan
            ]);

            $json = [
                'success' => 'Jurusan berhasil ditambahkan!'
            ];
        }


        return response()->json($json);
    }

    /**
     * Display the specified resource.
     */
    public function show(JurusanMahasiswa $jurusanMahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id_jurusan = $request->id_jurusan;

        $json = [
            'data' => view(
                'jurusanMahasiswa._edit',
                ['jurusan' => JurusanMahasiswa::find($id_jurusan)]
            )->render()
        ];

        return response()->json($json);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $namaJurusan = $request->nama_jurusan;
        $id_jurusan = $request->id_jurusan;
        $validator = validator()->make([
            'nama' => $namaJurusan
        ], [
            'nama' => ['required', 'min:3', 'string']
        ]);

        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {

            JurusanMahasiswa::whereId($id_jurusan)->update([
                'nama' => $request->nama_jurusan
            ]);

            $json = [
                'success' => 'Jurusan berhasil ditambahkan!'
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
            JurusanMahasiswa::destroy($request->id_jurusan);

            $json = [
                'success' => 'Jurusan Mahasiswa telah dihapus!'
            ];
        }

        return response()->json($json);
    }
}
