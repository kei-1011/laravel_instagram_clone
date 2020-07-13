<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;
use Validator;

class PostsController extends Controller
{
    // login check
    public function __construct() {
        $this->middleware('auth');
    }

    // 投稿一覧（トップページ）
    public function index() {

        // 10件の投稿を最新の日時順で取得
        $posts = Post::limit(10)->orderBy('created_at', 'desc')->get();
        return view('post/index', [
            'posts' => $posts,
        ]);
    }

    // 投稿ページ
    public function new() {
        return view('post/new');
    }

    // 投稿処理
    public function store(Request $request) {

        // validation入力チェック
        $validator = Validator::make($request->all(), [
            'caption'   =>  'required|max:255',
            'photo'     =>  'required'
        ]);

        // バリデーションエラーの場合
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Postモデルインスタンス
        $post = new Post;
        $post->caption = $request->caption;
        $post->user_id = Auth::user()->id;
        $post->save();

        $request->photo->storeAs('public/post_images', $post->id . '.jpg');

        return redirect('/');
    }
}
