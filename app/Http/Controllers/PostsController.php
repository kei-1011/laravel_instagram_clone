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

    public function index() {
        return view('post/index');
    }

    public function new() {
        return view('post/new');
    }

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
