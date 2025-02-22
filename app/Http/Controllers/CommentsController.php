<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    // store comment
    public function store(Request $request) {
        if ($request->parent_comment) {
            // Its a reply
            if ($request->reply) {
                // Store reply for comment
                Comment::create([
                    'post_id' => $request->post_id,
                    'user_id' => auth()->user()->id,
                    'parent_id' => $request->parent_comment,
                    'body' => $request->reply
                ]);

                return back();
            }

            return back();
        }

        else {
            // Its a comment
            // Validate
            $request->validate([
                'comment' => 'required'
            ]);

            // Create comment
            Comment::create([
                'post_id'   => $request->post_id,
                'user_id'   => auth()->user()->id,
                'body'      => $request->comment            
            ]);

            // return back
            return back();
        }
    }

    // Delete a comment
    public function destroy(Comment $comment) {
        $comment->delete();
        return back();
    }
}
