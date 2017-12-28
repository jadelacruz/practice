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
     * @var array
     */
    protected $guarded = [
        'id', 'created_at', 'updated_at'
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
        return $this->hasMany(Recipient::class)->with('user');
    }
}
