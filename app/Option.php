<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

    protected $fillable = ['title'];

    public $timestamps = false;
    public function discussion()
    {
        return $this->belongsTo('App\Discussion');
    }

    public function votes()
    {
        return $this->hasMany('App\Votes');
    }
}
