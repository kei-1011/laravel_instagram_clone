<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Validator;

class UsersController extends Controller
{
    public function __construct() {
    // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }
    public function show($user_id) {
        /**
         * firstOfFail
         * whereで与えられた条件にマッチする最初のレコードを返す
         * レコードが見つからない時は例外が発生し、エラー画面になる。
         * userテーブルからidと合致するユーザーを取得する
         */
        $user = User::where('id', $user_id)->firstOrFail();

        // 取得したuser情報をテンプレートに渡す
        return view('user/show', ['user' => $user]);
    }

    // ユーザー編集画面のルーティング
    public function edit() {
        $user = Auth::user();

        return view('user/edit', ['user' => $user]);
    }

    public function update(Request $request) {

        // validation
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_email' => 'required|string|max:255',
            'user_password' => 'required|string|min:6|confirmed',
        ]);

        // バリデーションがエラーの場合
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = User::find($request->id);
        // $userオブジェクトに$requestされた値を保存
        $user->name = $request->user_name;
        $user->email = $request->user_email;

        // プロフィール画像が送信された場合
        if ($request->user_profile_photo !=null) {
            // 画像を[user_id.jpg]の名前でstrage/app/user_imagesに保存
            $request->user_profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            $user->profile_photo = $user->id . '.jpg';
        }

        // password hash
        $user->password = bcrypt($request->user_password);

        //save
        $user->save();

        return redirect('/users/'.$request->id);
    }
}
