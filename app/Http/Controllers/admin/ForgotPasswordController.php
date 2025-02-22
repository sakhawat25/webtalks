<?php

namespace App\Http\Controllers\admin;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    // Get email for password recovery
    public function getEmail() {
        return view('admin.forgot_password');
    }

    // Send email with password recovery link
    public function postEmail(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        // Generate reset token
        $token = Str::random(64);

        // Send password reset link via email
        try {
            $resetLink = url('admin/reset-password/' . $token);

            Mail::send('emails.reset_password', ['resetLink' => $resetLink], function ($message) use($request) {
                $message->to($request->email);
                $message->subject('Password Reset Notification');
            });

            // Insert token in db
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            
            return back()->with('message', 'Password reset link has been emailed to you');

        } catch (Throwable $th) {
           return back()->with('message', $th->getMessage());
        }
    }
}
