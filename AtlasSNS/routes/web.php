<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login'); //ログイン画面表示
Route::post('/login', 'Auth\LoginController@login'); //ログイン処理

Route::get('/register', 'Auth\RegisterController@register'); //ユーザーの登録画面を表示させる
Route::post('/register', 'Auth\RegisterController@register'); //データベースにユーザー登録処理

Route::get('/added', 'Auth\RegisterController@added');
// Route::post('/added', 'Auth\RegisterController@added');




//ログイン中のページ
Route::get('/top', 'PostsController@index')->middleware('auth'); //トップページ表示, ->middleware('auth') をつけることで、ログイン済みのユーザーしかアクセスできなくなる。

Route::post('/post', 'PostsController@store')->middleware('auth');


// 投稿内容を更新
Route::put('/post/{id}/update', 'PostsController@update')->middleware('auth');

// 投稿削除
Route::post('/post/{id}/delete', 'PostsController@destroy')->middleware('auth');

Route::get('profile/{id}', 'UsersController@profile')->name('profile')->middleware('auth');
// Route::get('/profile', 'UsersController@profile');


Route::get('/search', 'UsersController@search')->middleware('auth');;

Route::get('/follow-list', 'FollowsController@followList');
Route::get('/follower-list', 'FollowsController@followerList');

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
