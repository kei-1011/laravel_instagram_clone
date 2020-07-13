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

Route::get('/', 'PostsController@index');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'PostsController@index');


/**
 * ユーザー編集画面の定義はユーザー詳細画面の画面より先に定義する
 * users/editのURLでアクセスした際、/users/{user_id}の定義と合致してしまう
 *
 * /users/editでアクセスしても、editが{user_id}であると認識されてしまい、エラーが発生する
 * このようなエラーを防ぐために、ルーティング定義の順番には気をつける
 */
// ユーザー編集
Route::get('/users/edit', 'UsersController@edit');

// ユーザー更新
Route::post('/users/update', 'UsersController@update');

// ユーザー詳細画面
Route::get('/users/{user_id}', 'UsersController@show');


// 投稿新規画面
Route::get('/posts/new','PostsController@new')->name('new');

// 投稿新規処理
Route::post('/posts','PostsController@store');

// 削除処理
Route::get('/postsdelete/{post_id}','PostsController@destroy');


// いいね
Route::get('/posts/{post_id}/likes','LikesController@store');

// いいね取り消し
Route::get('/likes/{like_id}','LikesController@destroy');


//コメント投稿処理
Route::post('/posts/{comment_id}/comments','CommentsController@store');

//コメント取消処理
Route::get('/comments/{comment_id}', 'CommentsController@destroy');
