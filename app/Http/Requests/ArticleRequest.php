<?php

namespace App\Http\Requests;
use App\Article;
use App\Http\Requests\Request;
use Auth;

class ArticleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if ($this->has('id')){
            // update
            $article = Article::findOrFail($this->get('id'));
            return Auth::user()->isAdmin() || $article->isOwnedByCurrentUser();
        } else {
            // create
            return Auth::user()->isAdmin();
        }

    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules  = [
            'title'     =>'required|min:3',
            'intro'     =>'required',
            'content'   =>'required',
            'slug'      =>'required|unique:articles'
        ];
        // if updating, ignore slug for current
        if ($this->method() == 'PATCH'){
            $rules['slug'] .= ',slug,' . $this->get('slug') . ',slug';
        }


        return $rules;
    }
}
