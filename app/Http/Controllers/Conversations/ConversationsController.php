<?php

namespace App\Http\Controllers\Conversations;

use App\Conversation;
use App\Message;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConversationsController extends Controller
{

    // rules for create, defined in construct, dynamic.
    protected $createRules = ['users.*' => 'required|exists:users,id'];
    protected $messages    = ['users.*' => 'Must select valid users.'];

    public function __construct() {
        $this->middleware('auth');
        if (Auth::check()){
            $createRules = ['users.*' => 'exists:users,id|not_in:' . Auth::user()->id];
        }
    }

    public function index ()
    {
        $conversations = Auth::user()->conversations->load('users');

        if ( Auth::user()->isAdmin() == true) {
            $allConversations = Conversation::with('users')->paginate(30);
        } else {
            $allConversations = null;
        }
        return View('conversations.list', compact('conversations', 'allConversations'));
    }

    public function create ()
    {
        return View('conversations.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, $this->createRules, $this->messages);
        $userIds           = $request->input('users');
        $userIds[]         = (string)Auth::user()->id;
        $userConversations = Auth::user()->conversations()->with('users')->has('users', '=', count($userIds))->get();

        sort($userIds);
        $found = false;

        foreach($userConversations as $conversation) {
            $arrUsers = $conversation->users->pluck('id')->toArray();
            sort($arrUsers);
            if ($arrUsers == $userIds) {
                return redirect(route('conversations.index'))->with('flashMessageError','You already have a conversation with these douches!');
            }
        }

        $conversation = Conversation::create();
        $conversation->users()->sync($userIds);

        $conversation->save();
        return redirect(route('conversations.index'))->with(['flashMessageSuccess' => 'Conversation created!']);

    }

    public function show($conversationId)
    {
        $conversation = Conversation::with('users')->findOrFail($conversationId);
        $users        = $conversation->users;
        $userIds      = $users->map(function($user, $key){ return $user->id;})->toArray();
        $user         = Auth::user();

        if (!in_array($user->id, $userIds)){
           return view('common.unauthorized');
        }

        $messages    = $conversation->messages->load('author');

        return view('conversations.conversation', compact('conversation', 'messages', 'users'));

    }

    public function destroy($conversationId)
    {
        // authorize
        if (Auth::user()->isAdmin() != true){
            return View('common.unauthorized');
        }

        // detach users
        $conversation = Conversation::with('users')->findOrFail($conversationId);
        $conversation->users()->detach();

        // delete messages
        $messages = $conversation->messages();
        $messages->delete();

        // delete conversation
        $conversation->delete();

        // redirect
        return redirect(route('conversations.index'))->with('flashMessageSuccess', 'Conversation deleted!');
    }
}
