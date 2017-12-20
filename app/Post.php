<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description'
    ];

    /**
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Post -> content
     *
     * @return object
     */
    public function recipient()
    {
        return $this->hasMany(Recipient::class);
    }

    public function viewed()
    {
        return $this->hasMany(Recipient::class)->whereNotNull('viewed_at');
    }

    public function confirmed()
    {
        return $this->hasMany(Recipient::class)->whereNotNull('confirmed_at');
    }
}
