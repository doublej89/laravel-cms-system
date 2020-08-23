<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Post extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getPostImageAttribute($value) {
        return asset($value);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
