<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * Userモデルとのリレーション
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * いいね機能
     * Likeモデルとのリレーション
     */
    public function likes() {
        return $this->hasMany('App\Like');
    }

    /**
     * 特定のユーザーのいいねがあるかどうかをチェックする
     */
    Public function likedBy($user) {
        return Like::where('user_id', $user->id)->where('post_id', $this->id);
    }
}
