<?php

namespace App\Http\Controllers;

use App\Models\JurusanMahasiswa;
use App\Models\Mahasiswa;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ContractsValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use LengthException;
use Mockery\Undefined;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword) {
            $data = Mahasiswa::join('jurusan_mahasiswa', 'jurusan_mahasiswa.id', '=', 'mahasiswa.id_jurusan_mahasiswa')
                ->where('mahasiswa.nama', 'LIKE', "%$keyword%")->orWhere('jurusan_mahasiswa.jurusan', "LIKE", "%$keyword%")->orWhere('mahasiswa.nim', "LIKE", "%$keyword%")->paginate();
        } else {
            $data = Mahasiswa::orderBy('created_at', 'desc')->paginate(9);
        }

        return view('mahasiswa.index', ['mahasiswa' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $json = [
            'view' => view('mahasiswa._create', ['jurusan' => JurusanMahasiswa::all()])->render()
        ];

        return response()->json($json);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $validator = Validator::make(
            [
                'nim' => $request->nim,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jurusan_mahasiswa' => $request->jurusan_mahasiswa
            ],
            [
                'nim' => 'required|string|min:6|max:10|' . Rule::unique('mahasiswa', 'nim'),
                'nama' => 'required|string|min:3',
                'alamat' => 'required|string',
                'no_telp' => 'required|numeric|min_digits:4',
                'jurusan_mahasiswa' => 'required'
            ]
        );
        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {

            Mahasiswa::create([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'id_jurusan_mahasiswa' => $request->jurusan_mahasiswa
            ]);

            $json = [
                'success' => 'Mahasiswa berhasil ditambahkan!'
            ];
        }

        return response()->json($json);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        if ($request->nim) {
            $json = [
                'data' => view('mahasiswa._edit', ['mahasiswa' => Mahasiswa::find($request->nim), 'jurusan' => JurusanMahasiswa::all()])->render()
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
                'nim' => $request->nim,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'jurusan_mahasiswa' => $request->jurusan_mahasiswa
            ],
            [
                'nim' => 'required|string|min:6|max:10|' . Rule::unique('mahasiswa', 'nim')->ignore($request->nim, 'nim'),
                'nama' => 'required|string|min:3',
                'alamat' => 'required|string',
                'no_telp' => 'required|numeric|min_digits:4',
                'jurusan_mahasiswa' => 'required'
            ]
        );
        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {

            Mahasiswa::whereNim($request->nim)->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'no_telp' => $request->no_telp,
                'id_jurusan_mahasiswa' => $request->jurusan_mahasiswa
            ]);

            $json = [
                'success' => 'Mahasiswa berhasil ditambahkan!'
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
            if (!$request->nim) {
                $json = [
                    'error' => 'Data mahasiswa tidak ada'
                ];
            } else {
                Mahasiswa::destroy($request->nim);
                $json = [
                    'success' => 'Data Mahasiswa berhasil Dihapus!'
                ];
            }
        }

        return response()->json($json);
    }
}
