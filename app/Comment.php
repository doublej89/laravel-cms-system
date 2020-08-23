<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'post_id',
        'author',
        'email',
        'body',
        'is_active'
    ];

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }
}
