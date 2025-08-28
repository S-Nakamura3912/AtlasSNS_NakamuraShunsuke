<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // 自分がフォローしているユーザー一覧を取得
    public function follows()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'followed_id');
        return $this->hasMany(Follow::class, 'following_id');
    }

    // 自分をフォローしているユーザー一覧を取得
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'following_id');
        return $this->hasMany(Follow::class, 'followed_id');
    }

    // 特定のユーザーをフォロー中かどうかを確認
    public function isFollowing($userId)
    {
        return $this->follows()->where('followed_id', $userId)->exists();
    }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'mail',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
