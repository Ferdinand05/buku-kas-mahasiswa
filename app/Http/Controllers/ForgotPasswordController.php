<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function check(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email']
        ]);


        $userEmail = $request->email;
        $checkEmail = User::whereEmail($userEmail)->first();
        if (!$checkEmail) {
            return throw ValidationException::withMessages([
                'email' => 'Your email does not match with our records!'
            ]);
        } else {
            $token = Str::random(60);
            DB::table('password_reset_tokens')->insert([
                'email' => $userEmail,
                'token' =>  $token,
                'created_at' => Carbon::now('Asia/Jakarta')
            ]);

            return redirect()->to(route('recover-password', $token));
        }
    }

    public function recover(Request $request, $token)
    {
        return view('auth.recover-password', ['token' => $token]);
    }

    // store new user password and change it
    public function passwordRecovery(Request $request, $token)
    {

        $request->validate([
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $user = DB::table('password_reset_tokens')->where('token', '=', $token)->first();

        User::whereEmail($user->email)->update([
            'password' => Hash::make($request->password_confirmation)
        ]);

        activity()->event('change password')->log('user with ' . $user->email . ' changed password!');

        // delete user in model password_reset_tokens
        DB::table('password_reset_tokens')->where('email', '=', $user->email)->delete();



        return redirect()->to(route('login'))->with('success', 'Password has been changed!');
    }
}
