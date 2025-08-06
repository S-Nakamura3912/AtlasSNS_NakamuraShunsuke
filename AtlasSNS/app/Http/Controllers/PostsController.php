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
        // ログインユーザーのフォロー中ユーザーのID一覧を取得
        $following_ids = Auth::user()->follows()->pluck('users.id')->toArray();

        // 自分自身の投稿も表示したい場合
        $following_ids[] = Auth::id();

        // フォローしているユーザーの投稿だけ取得
        $posts = Post::with('user')
            ->whereIn('user_id', $following_ids)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
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

    // ★ 投稿の編集
    // public function edit($id)
    // {
    //     $post = Post::findOrFail($id);

    //     // ログインユーザー以外が編集しようとした場合は拒否
    //     if ($post->user_id !== Auth::id()) {
    //         return redirect('/top')->with('error', '他のユーザーの投稿は編集できません。');
    //     }

    //     return view('posts.edit', compact('post'));
    // }

    // ★ 投稿の編集
    public function update(Request $request, $id)
    {
        $request->validate([
            'post' => 'required|string|max:150',
        ]);

        $post = Post::findOrFail($id);

        // 権限チェック
        if ($post->user_id !== Auth::id()) {
            return redirect('/top')->with('error', '他のユーザーの投稿は編集できません。');
        }

        $post->post = $request->input('post');
        $post->save();

        return redirect('/top')->with('success', '投稿を更新しました！');
    }

    // ★ 投稿の消去
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        // ログインユーザー本人の投稿かチェック
        if ($post->user_id !== Auth::id()) {
            return redirect('/top')->with('error', '他のユーザーの投稿は削除できません。');
        }

        $post->delete();

        return redirect('/top')->with('success', '投稿を削除しました。');
    }
}
