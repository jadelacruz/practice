<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'avatar', 'gender'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * User -> Post
     *
     * @return object
     */
    public function post()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * User -> Recipient
     *
     * @return object
     */
    public function notif()
    {
        return $this->hasMany('App\Recipient', 'recipient_id', 'id');
    }

    public function isAdmin()
    {
        return (boolean)$this->is_admin;
    }

    public function recipient()
    {
        return $this->where('id', '!=' , $this->id)->get();
    }
}
