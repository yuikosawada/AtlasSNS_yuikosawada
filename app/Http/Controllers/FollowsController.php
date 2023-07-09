<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class FollowsController extends Controller
{
    // まず全ての投稿と各投稿者の名前の表示
    public function show(){
        // Postモデル経由でpostsテーブルのレコードを取得
        $posts = Post::get();
        return view('follows.followList', compact('posts'));
      }
    //
    public function follow_list(){



        return view('follows.followList');
    }



    public function followerList(){
    
    
    
        return view('follows.followerList');
    }

    
}
