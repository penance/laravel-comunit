<?php

namespace App;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = ['title', 'intro', 'content', 'slug'];

    protected $hidden   = ['id', 'user_id'];

    public function author ()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function setSlugAttribute ($input){
        $this->attributes['slug'] = preg_replace('/[^\da-z]/i', '-', $input);
    }

    public function isOwnedByCurrentUser ()
    {
        $user = Auth::user();
        if (is_object($user) && $user->id = $this->user_id){
            return true;
        } else {
            return false;
        }
    }

    public function comments ()
    {
        return $this->hasMany('App\Comment');
    }
}
