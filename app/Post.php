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
}
