<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'content', 'user_id', 'conversation_id'
    ];

    protected $hidden = [
        'id'
    ];

    public function setUser () {
        $currentUser = Auth::user();

        if ($currentUser == null) {
            abort(403, 'Guests unauthorised by Message');
        }

        $this->attributes['user_id'] = $currentUser->id;
    }

    public function author () {
        return $this->user();
    }

    public function user () {
        return $this->belongsTo('App\User');
    }

    public function conversation (){
        return $this->belongsTo('App\Conversation');
    }
}
