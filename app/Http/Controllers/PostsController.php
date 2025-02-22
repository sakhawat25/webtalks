<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // Show all posts 
    public function all() {
        $data['posts'] = Post::latest()->paginate(10);
        $data['categories'] = Category::latest()->get();

        return view('front_end.posts', $data);
    }

    // Show single post
    public function single(Post $post) {
        $data['post'] = $post;

        return view('front_end.single', $data);
    }

    // Search
    public function search(Request $request) {
        // Filter by search input
        if ($request->search_box) {
            $data['posts'] = Post::filter(['search' => $request->search_box])->latest()->paginate(10);
        }
        else if ($request->tag) {
            $data['posts'] = Post::filter(['tag' => $request->tag])->latest()->paginate(10);
        }
        else if ($request->category) {
            $data['posts'] = Post::filter(['category' => $request->category])->latest()->paginate(10);
        }
        else {
            $data['posts'] = Post::latest()->paginate(10);
        }

        // Get categories
        $data['categories'] = Category::latest()->get();

        // Show search results on appropriate view
        $routes = explode('/', url()->previous());

        foreach ($routes as $route) {
            $currentRoute = $route;
        }
        
        switch ($currentRoute) {
            case 'all':
                $view = 'front_end.posts';
                return view($view, $data);
                break;

            case 'single':
                $view = 'front_end.posts';
                return view($view, $data);
                break;
            
            default:
                $view = 'front_end.home';
                $data['featuredPosts'] = Post::where('featured', 1)->latest()->get();
                return view($view, $data);
        }

        
    }
}
