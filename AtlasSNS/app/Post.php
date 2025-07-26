<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'post'];

    // ここに追加
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
