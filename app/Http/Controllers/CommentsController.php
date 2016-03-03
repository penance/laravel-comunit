<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comment;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;

class CommentsController extends Controller
{
    protected $createRules = ['content' => 'min:3'];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store ($article_id, Request $request)
    {
        // validate input
        $this->validate($request, $this->createRules);

        // must have this article
        $article = Article::findOrFail($article_id);



        $content = $request->get('content');
        $comment = New Comment;
        $comment->user_id       = Auth::user()->id;
        $comment->article_id    = $article_id;
        $comment->content       = $request->input('content');

        $comment->save();

        return redirect(route('articles.show', ['articles' => $article->slug]))->with(['flashMessageSuccess', 'Comment added!']);

    }

    public function destroy ($commentId, Request $request)
    {
        if (Auth::user()->isAdmin() != true){
            return View('common.unauthorized');
        }

        $comment = Comment::findOrFail($commentId);
        $comment->delete();
        $comments = Comment::orderBy('created_at', 'desc')->with('article')->with('user')->paginate(30);
        return redirect(route('comments.index'))->with(['flashMessageSuccess' => 'Comment deleted.']);



    }

    public function index()
    {
        if (Auth::user()->isAdmin() != true){
            return View('common.unauthorized');
        }

        $comments = Comment::orderBy('created_at', 'desc')->with('article')->with('user')->paginate(30);
        return View('comment.index', compact('comments'));
    }
}
