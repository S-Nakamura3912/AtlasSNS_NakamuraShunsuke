<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth; // ← これを追加！
use App\Follow; // Followテーブルを使う


class UsersController extends Controller
{
    // プロフィールページ
    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('users.profile', compact('user'));
    }

    // ユーザー検索
    public function search(Request $request)
    {
        $keyword = $request->input('username');
        $loginUserId = Auth::id(); // ログイン中のユーザーID取得


        // キーワードがあれば絞り込み、なければ全件取得
        $users = User::when($keyword, function ($query, $keyword) {
            return $query->where('username', 'like', "%{$keyword}%");
            // return $query->where('username', 'like', '%'.$keyword.'%');
        })
            ->where('id', '!=', $loginUserId) // 自分を除外
            ->get();

        return view('users.search', compact('users', 'keyword'));
    }

    // フォロー
    public function follow($id)
    {
        Follow::create([
            'following_id' => Auth::id(),
            'followed_id' => $id,
        ]);

        // 検索画面にリダイレクト
        return redirect('/search');
    }

    // フォロー解除
    public function unfollow($id)
    {
        Follow::where('following_id', Auth::id())
            ->where('followed_id', $id)
            ->delete();

        // 検索画面にリダイレクト
        return redirect('/search');
    }
}
