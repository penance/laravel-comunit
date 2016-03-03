<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class AccessLevel extends Model
{
    //



    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\User', 'level_id', 'id');
    }

}
