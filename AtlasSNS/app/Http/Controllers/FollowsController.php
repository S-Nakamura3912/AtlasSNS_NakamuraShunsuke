<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    // フォローする
    public function follow($id)
    {
        $user = Auth::user();               // ① 現在ログインしているユーザーを取得
        $user->follows()->attach($id);      // ② フォロー先のユーザーIDを中間テーブルに追加
        return back();                      // ③ 元のページにリダイレクト
    }

    // フォロー解除
    public function unfollow($id)
    {
        $user = Auth::user();               // ① 現在ログインしているユーザーを取得
        $user->follows()->detach($id);      // ② 中間テーブルから該当のユーザーIDを削除
        return back();                      // ③ 元のページにリダイレクト
    }

    public function followList()
    {
        return view('follows.followList');
    }
    public function followerList()
    {
        return view('follows.followerList');
    }
}
