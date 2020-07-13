<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * hasManyは、他のモデルとの間に「1対多」のつながりがあることを示す。「1側」にhasManyを追加
     */
    public function posts() {
        return $this->hasMany('App\Post');
    }

    public function likes() {
        return $this->hasMany('App\Like');
    }
}
