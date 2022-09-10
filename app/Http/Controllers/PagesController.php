<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
	// Show home page
	public function home()
	{
		$data['posts'] = Post::latest()->paginate(5);
		$data['featuredPosts'] = Post::where('featured', 1)->latest()->get();
		$data['categories'] = Category::latest()->get();
		return view('front_end.home', $data);
	}

	// Show about page
	public function about()
	{
		return view('front_end.about');
	}

	// Show contact page
	public function showContact()
	{
		return view('front_end.contact');
	}

	// Show user profile
	public function showProfile()
	{
		return view('front_end.profile');
	}

	// Perform contact functions
	public function contact(Request $request)
	{
		// Do some validation
		$request->validate([
			'name' => 'required|min:4',
			'email' => 'required|email',
			'message' => 'required|min:5',
		]);

		// Store message
		Message::create([
			'name' => $request->name,
			'email' => $request->email,
			'message' => $request->message,
		]);

		return back()->with('message', 'Your message has been received, We will reply you shortly');
	}
}
