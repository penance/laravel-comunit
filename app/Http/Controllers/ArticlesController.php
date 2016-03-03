<?php

namespace App\Http\Controllers;



use Request;
use App\Http\Controllers\Controller;
use Gate;
use Redirect;
use Auth;
use App\Article;
use App\Http\Requests\ArticleRequest;

class ArticlesController extends Controller
{


    public function index()
    {
        $validationResult = $this->isPermited('view');
        if ($validationResult !== true) {
            return $validationResult;
        }

        $articles = Article::latest()->with('author')->paginate(15);
        return view('article.blog', compact('articles'));
    }

    // handles post tp /articles. to be used as form target of create
    // /articles
    public function store(ArticleRequest $request)
    {
        $article            = new Article($request->all());
        $article->user_id   = Auth::user()->id;
        $article->save();
        return Redirect('articles')->with(['flashMessageSuccess' => 'Article created successfully!']);
    }

    // handle get request, show empty form
    // /articles/create
    public function create()
    {
        $authorization = $this->isPermited('create');
        if ($authorization !== true){
            return $authorization;
        }

        return view('article.create');
    }

    // handle DELETE requests, deletes article
    // /articles/slug
    public function destroy($slug)
    {
        $article = Article::where('slug', '=', $slug)->firstOrFail();
        $article->delete();
        $articles = Article::all();

        return view('article.blog', compact('articles'))->with('flashMessageSuccess', 'Deleted successfully');
    }

    // handles put|patch requests. updates article, form target of edit
    // /articles/slug
    public function update($slug, ArticleRequest $request)
    {
        $article = Article::where('slug', $slug)->with('author')->firstOrFail();
        $authorization = $this->isPermited('update', $article);
        if ($authorization !== true){
            return $authorization;
        }

         $article->update($request->all());
        return redirect(route('articles.edit', ['articles' => $article->slug]))->with(['flashMessageSuccess' => 'Article updated successfully', ]);
    }

    // handle get requests to
    // /articles/slug
    public function show($slug)
    {
        $validationResult = $this->isPermited('view');
        if ($validationResult !== true) {
            return $validationResult;
        }
        $article = Article::where('slug', $slug)->with('author')->firstOrFail();
        $comments = $article->comments()->orderBy('created_at', 'desc')->get();
        $article->comments = $comments;

        return View('article.article', compact('article'));
    }

    // show populated edit form
    // /articles/slug/edit
    public function edit($slug)
    {

        $validationResult = $this->isPermited('edit');
        if ($validationResult !== true) {
            return $validationResult;
        }

        $article = Article::where('slug', $slug)->with('author')->firstOrFail();
        return View('article.edit', compact('article'));
    }

    protected function isPermited($action, $article = null)
    {
        if ($article == null){
            $article = Article::class;
        }

        if (Gate::denies($action, $article)){
            return View('common.unauthorized');
        } else {
            return true;
        }
    }


}
