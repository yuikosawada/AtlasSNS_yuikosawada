<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'post'];


    // リレーション
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function follows()
    {
        return $this->belongsTo('App\Follow');
    }
}
