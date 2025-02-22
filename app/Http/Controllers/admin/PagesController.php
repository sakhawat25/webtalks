<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Message;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    // Show dashboard
    public function dashboard() {
        $data['posts'] = Post::all();
        $data['categories'] = Category::all();
        $data['comments'] = Comment::whereNull('parent_id')->get();
        $data['users'] = User::all();
        $data['messages'] = Message::all();
        return view('admin.pages.dashboard', $data);
    }
}
