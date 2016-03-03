<?php

namespace App\Http\Controllers\Conversations;

use App\Message;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Conversation;
use Redirect;

class MessagesController extends Controller
{


    public function store($conversation_id, Request $request)
    {
        // find conversation
        $conversation   = Conversation::with('users')->findOrFail($conversation_id);

        $content        = $request->input('content');

        // see that user is part of conversation

        $user_id            = Auth::user()->id;
        $conversationUsers = $conversation->users->pluck('id')->toArray();
        if (!in_array($user_id, $conversationUsers)){
            return View('common.unauthorized');
        }

        // add message
        $message = Message::create(compact('user_id', 'conversation_id', 'content'));
        $message->conversation_id = $conversation_id;
        $message->user_id         = $user_id;

        $message->save();
        // redirect / respond
        return redirect(route('conversations.show', $conversation_id));
    }
}
