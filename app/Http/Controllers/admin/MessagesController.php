<?php

namespace App\Http\Controllers\admin;

use Throwable;
use App\Models\Message;
use App\Mail\ReplyEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{
    // Show all messages
    public function index() {
        $data['messages'] = Message::latest()->get();
        return view('admin.messages.index', $data);
    }

    // Store message reply
    public function store(Request $request) {
        // Validation
        $request->validate([
            'messageReply' => 'required|min:4'
        ]);

        // Get message object
        $message = Message::find($request->message_id)->first();

        // Send reply via email service
        try {
            Mail::to($message->email)->send(new ReplyEmail(['message' => $message, 'reply' => $request->messageReply]));
        } catch (Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        // Store message reply
        $message->update([
            'reply' => $request->messageReply,
            'is_replied' => 1
        ]);
        
        return back()->with('message', 'Message has been sent successfully')->with('status', 'success');
    }

    // Show single message info
    public function show(Message $message) {
        return "
            <div class='mb-5'>
                <div class='row'>
                    <div class='col-2'>
                        <strong>From</strong>
                    </div>
                    <div class='col-8'>
                        <strong>" . $message->name . "</strong>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-2'></div>
                    <div class='col-8'>&lt;" . $message->email . "&gt;</div>
                </div>
                <div class='row'>
                    <div class='col-2'></div>
                    <div class='col-8 text-danger'><small>" . $message->created_at . "</small></div>
                </div>
            </div>

            <div class='message-header mb-3'>
                <p>" . $message->message . "</p>
            </div>

            <div class='message-header bg-dark py-4'>
                <form action='" . url('admin/messages/') . "' method='POST' id='messageReplyForm'>"
                    . csrf_field() .
                    "<input type='hidden' name='message_id' value='" . $message->id . "'>
                    <div class='form-group' id='messageReplyInputWrapper'>
                        <textarea class='form-control bg-white rounded' name='messageReply' id='messageReplyTextArea' cols='30' rows='10'>" . $message->reply . "</textarea>
                    </div>
                    <button type='submit' class='btn btn-primary'>Reply</button>    
                </form>   
            </div>
            
            <script>
                $('#messageReplyForm').on('submit', function (event) {
                    let reply = $('#messageReplyTextArea');                                        
                    
                    if (reply.val() === '') {
                        $('#messageReplyInputWrapper').append(\"<div class='text-white mt-2 py-2 px-3 bg-danger'>You haven't typed anything!</div>\");
                        return false;
                    }
                });
            </script>";
    }

    // Delete message
    public function destroy(Message $message) {
        $message->delete();
        return back()->with('message', 'Message has been deleted successfully!');
    }
}
