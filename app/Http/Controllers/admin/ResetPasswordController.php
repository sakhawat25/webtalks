<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    // Show reset password form
    public function showResetForm($token) {
        return view('admin.reset_password', ['token' => $token]);
    }

    // Rest password
    public function resetPassword(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:5|confirmed',
        ]);

        $updatePassword = DB::table('password_resets')
                            ->where(['email' => $request->email, 'token' => $request->token])->first();

        if(!$updatePassword) {
            return back()->withInput()->with('message', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
                    ->update(['password' => bcrypt($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();

        return redirect('/admin/login')->with('message', 'Your password has been changed!');
    }
}
