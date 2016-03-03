<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\message;

class Conversation extends Model
{
    protected $fillable = [];
    protected $hidden   = ['id'];

    public function users ()
    {
        return $this->belongsToMany('App\User');
    }

    public function messages ()
    {
        return $this->hasMany('App\Message');
    }
}
