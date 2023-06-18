<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 投稿一覧画面
    // public function getTimeLines(Int $user_id, array $follow_ids)
    // {
    //     // 自身とフォローしているユーザIDを結合する
    //     $follow_ids[] = $user_id;
    //     return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'DESC')->paginate(50);
    // }
}
