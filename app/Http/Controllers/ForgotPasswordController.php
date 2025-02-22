<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    // Show password revovery form
    public function index() {
        return view('front_end.forgot_password');
    }

    // Send password recovery link via email to the user
    public function sendRecoveryLink(Request $request) {
        // Validation
        $request->validate(['email' => 'required|email|exists:users,email']);

        // Generate reset token
        $token = Str::random(64);

        // Send recovery email
        try {
            $resetLink = url('reset-password/' . $token);
            
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
