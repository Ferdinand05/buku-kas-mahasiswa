<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {

        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['email', 'required'],
            'password' => ['required']
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            activity()->event('Logged in')->causedBy(auth()->user()->id)->log(Auth::user()->name . ' Logged in!');
            return redirect()->route('dashboard');
        } else {
            return  throw ValidationException::withMessages([
                'email' => 'Your Credentials does not match with our records!'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
