<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post; // Postモデルが必要
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    // 投稿一覧ページ
    public function index()
    {
        return view('posts.index');
    }

    // ★ 新規投稿の保存処理（これを追加！）
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'post' => 'required|string|max:150',
        ]);

        // 保存処理
        Post::create([
            'user_id' => Auth::id(), // ログインユーザーIDを保存
            'post' => $request->input('post'),
        ]);

        // 投稿後にリダイレクト
        return redirect('/post')->with('success', '投稿が完了しました！');
    }
}
