<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consent extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Discussion');
    }
}
