<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // userテーブルとのリレーション
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function posts() {
        return $this->belongsTo('App\Post');
    }
}
