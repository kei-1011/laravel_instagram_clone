<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use App\Post;
use Validator;

class LikesController extends Controller
{
    public function __construct() {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }
    // いいね追加
    public function store(Request $request) {
        $like = new Like;
        $like->post_id = $request->post_id;
        $like->user_id = Auth::user()->id;
        $like->save();

        return redirect('/');
    }

    // いいね削除
    public function destroy(Request $request) {
        $like = Like::find($request->like_id);
        $like->delete();
        return redirect('/');
    }
}
