<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Recipient extends Model
{
    protected $fillable = [
        'post_id', 'user_id', 'recipient_id', 'viewed_at', 'forwarded_at'
    ];

    public function post()
    {
        return $this->belongsTo(\App\Post::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function scopeNotViewed($query)
    {
        return $query->whereNull('viewed_at');
    }

    public function scopeViewed($query)
    {
        return $query->whereNotNull('viewed_at');
    }

    public function scopeReceived($query)
    {
        return $query->whereNotNull('received_at');
    }

    public function scopeConfirmed($query)
    {
        return $query->whereNotNull('confirmed_at');
    }

    public function isViewed()
    {
        return ($this->viewed_at === null) ? false : true;
    }

    public function isReceived()
    {
        return ($this->received_at === null) ? false : true;
    }

    public function confirmed()
    {
        return ($this->confirmed_at === null) ? false : true;
    }
}
