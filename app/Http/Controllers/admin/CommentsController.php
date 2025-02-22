<?php

namespace App\Http\Controllers\admin;

use App\Models\Comment;
use App\Mail\ApproveComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CommentsController extends Controller
{
    // Show all comments
    public function index () {
        $comments = Comment::whereNull('parent_id')->latest()->get();
        $data['comments'] = $comments;
        return view('admin.comments.index', $data);
    }

    // Show single comment
    public function show(Comment $comment) {
        $data['comment'] = $comment;
        return view('admin.comments.show', $data);
    }

    // Delete a comment
    public function destroy(Comment $comment) {
        $comment->delete();
        return redirect('admin/comments')->with('message', 'Comment has been deleted successfully!');
    }
}
