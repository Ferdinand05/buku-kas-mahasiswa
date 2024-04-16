<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (Auth::user()->getRoleNames()[0] == 'super admin') {
            return view('user.index', ['users' => User::all()]);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $data = [
            'view' => view('user._create', ['roles' => $roles])->render()
        ];
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role
            ],
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6',
                'role' => 'required'
            ]
        );

        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            $user->assignRole(intval($request->role));



            $json = [
                'success' => 'User baru berhasil di Daftarkan!'
            ];
        }

        return response()->json($json);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $json = [
            'view' => view('user._edit', [
                'user' => User::find($request->user_id),
                'roles' => Role::all()
            ])->render()
        ];

        return response()->json($json);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make(
            [
                'nama' => $request->nama,
                'email' => $request->email,
                'role' => $request->role
            ],
            [
                'nama' => 'required|min:3',
                'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($request->email, 'email'),
                'role' => 'required'
            ]
        );

        if ($validator->fails()) {
            $json = [
                'error' => $validator->errors()->getMessages()
            ];
        } else {
            User::where('id', $request->user_id)->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => $request->password
            ]);

            $user = User::where('id', $request->user_id)->first();
            $user_role = $user->getRoleNames()[0];
            $user->removeRole($user_role);
            $user->assignRole(intval($request->role));

            activity()->event('Updated')->causedBy(auth()->user()->id)
                ->performedOn($user)->log('Updated ' . $request->email . " - " . $user_role);

            $json = [
                'success' => 'User  berhasil di Update!'
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
            $user = User::find($request->user_id);
            $role_name = $user->getRoleNames()[0];
            $user->removeRole($role_name);
            $user->delete();

            $json = [
                'success' => 'Admin user berhasil Dihapus!'
            ];
        }

        return response()->json($json);
    }
}
