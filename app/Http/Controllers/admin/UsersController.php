<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Mail\RegisterEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    // Show all users
    public function index() {
        $users = User::where('verification_code', '!=', '$2y$10$n8rIoiDkfHfLsB2teVg2OubuETJ9phPK4.69lGJPmzKvONErg1m8m')->latest()->get();
        $data['users'] = $users;
        return view('admin.users.index', $data);
    }

    // Show a single user record
    public function show(User $user) {
        $data['user'] = $user;
        return view('admin.users.show', $data);
    }

    // Verify user
    public function verify(User $user) {
        if ($user->is_verified === 1) {
            return back()->with('message', 'This user has already been verified.');
        }

        // Send verificatio email
        Mail::to($user->email)->send(new RegisterEmail([
            'user' => $user,
            'verification_code' => $user->verification_code
        ]));

        return back()->with('message', 'Verification email has been sent to the user');
    }

    // Delete user account
    public function destroy(User $user) {
        if ($user->image !== 'avatar.jpg') {
            // Delete user image
            $filePath = public_path('images\\' . $user->image);
            $fileSystem = new Filesystem();            
            $fileSystem->delete($filePath);
        }

        $user->delete();
        return back()->with('message', 'User account has been deleted successfully!');
    }
}
