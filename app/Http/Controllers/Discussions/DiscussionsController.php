<?php

namespace App\Http\Controllers\Discussions;

use App\Discussion;
use App\Events\Discussion\Created;
use App\Http\Requests\DiscussionCreationRequest;
use App\Option;
use Auth;
use Event;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DiscussionsController extends Controller
{

    public function index ()
    {
        $discussions = Discussion::latest()->with('user')->with('options')->paginate(10);
        return View('discussions.index', compact('discussions'));
    }

    public function create ()
    {
        return View('discussions.create');
    }

    public function store (DiscussionCreationRequest $request)
    {
        // create discussion
        $discussion = new Discussion($request->all());
        $discussion->user_id = Auth::user()->id;
        $discussion->save();

        // save it's options
        foreach ($request->input('options') as $title){
            $option = new Option(compact('title'));
            $option->discussion_id =  $discussion->id;
            $option->save();
        }

        Event::fire(new Created($discussion));
        // we are done, redirect
        return redirect(route('discussions.index'))->with('flashMessageSuccess', 'Your discussion was created! Call the douches, and tell them to allow it.');
    }


}
