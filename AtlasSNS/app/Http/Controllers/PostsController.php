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
        $validated = $request->validate([
            'post' => 'required|string|max:150',
        ], [
            'post.required' => '投稿内容は必須です。',
            'post.string' => '投稿内容は文字列で入力してください。',
            'post.max' => '投稿内容は150文字以内で入力してください。',
        ]);



        // 保存処理
        Post::create([
            'user_id' => Auth::id(), // ログインユーザーIDを保存
            'post' => $validated['post'],
        ]);

        // 投稿後にリダイレクト
        return redirect('/top')->with('success', '投稿が完了しました！');
    }
}
