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
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // リレーション
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'follows', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }




        // フォローする
        public function follow($userId) 
        {
            return $this->follows()->attach($userId);
        }
    
        // フォロー解除する
        public function unfollow($userId)
        {
            return $this->follows()->detach($userId);
        }
    
        // フォローしているか
        public function isFollowing($userId) 
        {
            return (boolean) $this->follows()->where('followed_id', $userId)->first(['followed_id']);
        }
    
        // フォローされているか
        public function isFollowed($userId) 
        {
            return (boolean) $this->followers()->where('following_id', $userId)->first(['following_id']);
        }
    
}
