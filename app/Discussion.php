<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['title', 'proposal'];

    // default values for model
    protected $attributes = ['status_id' => '2'];

    public function status () {
        return $this->belongsTo('App\Status');
    }

    public function consents ()
    {
        return $this->hasMany('App\Consent');
    }

    public function options ()
    {
        return $this->hasMany('App\Option');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
