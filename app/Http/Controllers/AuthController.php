<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Mail\RegisterEmail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AuthController extends Controller
{
    // Shoe registration form
    public function registerForm() {
        return view('front_end.register');
    }

    // Shoe Login form
    public function loginForm() {
        return view('front_end.login');
    }

    // Perform registration process
    public function register(Request $request) {
        // Validation
        $request->validate([
            'name'                  => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed|min:5',
            'password_confirmation' => 'required',
            'image'                 => 'mimes:jpg,jpeg,png'
        ]);

        // Store image on cloud
        $imageName = $request->hasFile('image') ? date('d_m_y_') . time() . '_' . pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME) : 'avatar';

        if ($request->hasFile('image')) {
            $result = $request->image->storeOnCloudinaryAs('images', $imageName);
        }  

        // Generate verification code
        $verificationCode = str_replace('/', '', bcrypt(time()));

        // Send verification email
        try {
            Mail::to($request->email)->send(new RegisterEmail([
                'user' => $request->name,
                'verification_code' => $verificationCode
            ]));

            // Create a new user
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = $imageName;
            $user->verification_code = $verificationCode;
            $user->password = bcrypt($request->password);
            $user->save();

            return redirect()->back()->with('info', 'Registration has been successful, please check your inbox to verify you email.');

        } catch (Throwable $th) {
            return back()->with('info', $th->getMessage());
        }        
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
        if ($user->is_verified === 1) {
            // do login process
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                return redirect('/')->with('message', 'You have been signed in successfully.');
            }
            else {
                return back()->with('info', 'Wrong login credientials!')->withInput();
            }
        }
        else {
            // show message for email verification
            return back()->with('info', 'Please verify your email to log in to your account.');
        }
    }

    // Logout
    public function logout() {
        Auth::logout();
        return redirect('login')->with('message', 'You have been logged out successfully!');
    }

    // Perform email verification
    public function verifyEmail($code) {
        $user = User::where('verification_code', $code)->first();
        if ($user) {
            // successful verification
            $user->is_verified = 1;
            $user->email_verified_at = date_create();
            $user->save();

            return redirect('login')->with('message', 'Your email has been verified, you can now log in to your account.');
        }
        else {
            // Verification failed
            return redirect('register')->with('info', 'There was some problem while verifying your email, please try later.');
        }
    }

    // Update user record
    public function update(Request $request) {
       $request->validate([
            'name' => 'required|min:4',
            'image' => 'mimes:jpg,jpeg,png'
       ]);

       // Set new image name if updated
       $imageName = $request->hasFile('image') ? date('d_m_y_') . time() . '_' . pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME) : auth()->user()->image;

       // check if file has been uploaded
       if ($request->hasFile('image')) {
            if (auth()->user()->image !== 'avatar') {
                // delete old image
                Cloudinary::destroy('images/' . auth()->user()->image);
            }

            // Upload new image on cloud
            $result = $request->image->storeOnCloudinaryAs('images', $imageName);
       }

       // Update record
       auth()->user()->update([
            'name' => $request->name,
            'image' => $imageName
       ]);

       return redirect('profile')->with('message', 'Your profile has been updated successfully!');
    }

    // Delete profile picture
    public function delete(Request $request) {
        if (auth()->user()->image !== 'avatar') {
            // Delete picture
            Cloudinary::destroy('images/' . auth()->user()->image);

            // Set default picture
            auth()->user()->update(['image' => 'avatar']);
        }

        return asset('images/' . auth()->user()->image);
    }
}
