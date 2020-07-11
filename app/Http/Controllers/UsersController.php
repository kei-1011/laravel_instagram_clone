<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show(int $user_id) {
        /**
         * firstOfFail
         * whereで与えられた条件にマッチする最初のレコードを返す
         * レコードが見つからない時は例外が発生し、エラー画面になる。
         * userテーブルからidと合致するユーザーを取得する
         */
        $user = User::where('id', $user_id)->first();

        // 取得したuser情報をテンプレートに渡す
        return view('user/show', ['user' => $user]);
    }
}
