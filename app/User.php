<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'level_id'
    ];

    public function accessLevel()
    {
        return $this->belongsTo('App\AccessLevel', 'level_id');
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function isAdmin()
    {
        return $this->level_id > 1;

    }

    /**
     * Mutator to encrypt password
     * @param string $value
     */
    public function setPasswordAttribute ($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function conversations ()
    {
        return $this->belongsToMany('App\Conversation');
    }

    public function comments ()
    {
        return $this->hasMany('App\Comment');
    }

    public function consents()
    {
        return $this->hasMany('App\Consent');
    }

    public function opinions()
    {
        return $this->hasMany('App\Opinion');
    }

    public function votes()
    {
        return $this->hasMany('App\Vote');
    }
}
