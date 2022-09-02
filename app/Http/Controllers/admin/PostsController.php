<?php

namespace App\Http\Controllers\admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;

class PostsController extends Controller
{
    // Posts homepage
    public function index(Request $request)
    {
        $data['posts'] = Post::latest()->get();
        return view('admin.posts.index',  $data);
    }

    // Form to create post
    public function create()
    {
        $data['categories'] = Category::get();
        return view('admin.posts.create', $data);
    }

    // Store a newly created poat
    public function store(Request $request)
    {   
        // Validation
        $request->validate([
            'title'        => 'required|unique:posts,title|min:5',
            'author'        => 'required|min:5',
            'description'   => 'required|min:100',
            'tags'          => 'required|min:2',
            'image'         => 'mimes:jpg,jpeg,png'
        ]);

        // Create post slug
        $slug = Str::slug($request->title);

        // Store image in storage
        $imageName = $request->hasFile('image') ? date('d_m_y_') . time() . '_' . $request->image->getClientOriginalName() : 'no_image.jpg';

        if ($request->hasFile('image')) {
            $request->image->move(public_path('images'), $imageName);
        }        

        // Store data in database
        Post::create([
            'title'         => $request->title,
            'category_id'   => $request->category,
            'author'        => $request->author,
            'slug'          => $slug,
            'description'   => $request->description,
            'tags'          => $request->tags,
            'image'         => $imageName
        ]);

        return redirect('admin/posts')->with('message', 'Post has been created successfully!');
    }

    // Show single post
    public function show(Post $post)
    {
        $data['post'] = $post;
        return view('admin.posts.show', $data);
    }

    // Show edit form
    public function edit(Post $post)
    {
        $data['post'] = $post;

        $data['categories'] = Category::get();

        return view('admin.posts.edit', $data);
    }

    // Update post
    public function update(Request $request, Post $post)
    {
        // Validation
        $request->validate([
            'title'        => 'required|min:5|unique:posts,title,' . $post->id,
            'author'        => 'required|min:5',
            'description'   => 'required|min:100',
            'tags'          => 'required|min:2',
            'image'         => 'mimes:jpg,jpeg,png'
        ]);

        // Create post slug
        $slug = Str::slug($request->title);

        // Set new image name if updated
        $imageName = $request->hasFile('image') ? date('d_m_y_') . time() . '_' . $request->image->getClientOriginalName() : $post->image;

        if ($request->hasFile('image')) {
            // Delete old image
            $this->deleteImage($post);

            // Upload new image
            $request->image->move(public_path('images'), $imageName);
        }        

        // Store data in database
        $post->update([
            'title'         => $request->title,
            'category_id'   => $request->category,
            'author'        => $request->author,
            'slug'          => $slug,
            'description'   => $request->description,
            'tags'          => $request->tags,
            'image'         => $imageName
        ]);

        return redirect('admin/posts')->with('message', 'Post has been updated successfully!');
    }

    // Remove post from database
    public function destroy(Post $post)
    {
        // Delete post image if present
        $this->deleteImage($post);

        // Delete post
        $post->delete();

        return back()->with('message', 'Post has been deleted successfully!');
    }

    // Update featured post
    public function feature(Post $post) {
        if ($post->featured === 0) {
            $post->featured = 1;
            $message = "Post has successfully become featured";
        }
        else {
            $post->featured = 0;
            $message = "Post has become unfeatured";
        }

        $post->save();

        return back()->with('message', $message);
    }

    // Search post
    public function search(Request $request) {
        if ($request->tag) {
            $posts = Post::filter(['tag' => $request->tag])->latest()->get();
            $data['posts'] = $posts;
            return view('admin.posts.index', $data);
        }
        else if ($request->category) {
            $posts = Post::filter(['category' => $request->category])->latest()->get();
            $data['posts'] = $posts;
            return view('admin.posts.index', $data);
        }     
    }

    // Delete post image from local directory if present
    public function deleteImage(Post $post) {
        // Delete post image if present
        if ($post->image != 'no_image.jpg') {
            $filePath = public_path('images\\' . $post->image);
            $fileSystem = new Filesystem();            
            $fileSystem->delete($filePath);
            return true;
        }

        return false;
    }

    // Show all featured posts
    public function showFeatured() {
        $data['posts'] = Post::where('featured', 1)->latest()->get();
        return view('admin.posts.featured', $data);
    }
}
