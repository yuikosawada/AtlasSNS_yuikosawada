<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = ['following_id', 'followed_id'];

    //     // 多対多のリレーション
    //     public function follows()
    //     {
    //         return $this->belongsToMany('App\User', 'follows', 'following_id', 'followed_id');
    //     }
    //    public function follower()
    //     {
    //         return $this->belongsToMany('App\User', 'follows', 'followed_id', 'following_id');
    //     }


    // フォローしているユーザのIDを取得
    public function followingIds(Int $user_id)
    {
        return $this->where('following_id', $user_id)->get('followed_id');
    }

    

    // フォローされているか
    public function isFollowed(Int $user_id)
    {
        return (bool) $this->follower()->where('following_id', $user_id)->first(['id']);
    }
}
