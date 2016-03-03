<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content'];
    protected $hidden   = ['id'];


    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function author ()
    {
        return $this->user();
    }

    public function by($user)
    {
        if ($user instanceof User){
            $id = $user->id;
        } else {
            $id = $user;
        }

        return $id == $this->user_id;
    }

    public function ownedBy($user)
    {
        return $this->by($user);
    }
}
