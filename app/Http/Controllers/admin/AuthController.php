<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show login form
    public function showLogin() {
        return view('admin.auth.login');
    }

    // Perform login process
    public function login(Request $request) {
        // Validation
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        // Find if verified user
        $user = User::where('email', $request->email)->first();
        if ($user->is_admin === 1) {
            // do login process
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('admin')->with('message', 'You have been signed in successfully.');
            }
            else {
                return back()->with('message', 'Wrong login credientials!')->withInput();
            }
        }
        else {
            // show message for email verification
            return back()->with('message', 'Unauthorized User')->withInput();
        }
    }

    // Do logout
    public function logout() {
        auth()->logout();
        return redirect('admin/login')->with('message', 'You have been logged out successfully!');
    }
}