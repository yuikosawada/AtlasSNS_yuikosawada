<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use App\Post;
use App\Follow;
// use Illuminate\Support\Facades\Auth;
use Auth;

class PostsController extends Controller
{

    public function index()
    {
        // postsフォルダのindex.bladeを表示
        return view('posts.index');
    }

    // 新規投稿
    public function store_post(Request $request)
    {

        // 新規投稿の保存
        $post = new Post();
        $post->post = $request->input('post_content');
        $post->user_id = auth()->id();
        $post->save();

        return redirect('/top')->with('success', '投稿が成功しました');
    }

    //ここまでで新規登録はできている
    // ここから下編集中。タイムライン表示したい。 

    public function all_post()
    {
        // 全ての投稿を取得してタイムラインで表示
        $posts = Post::orderBy('created_at', 'desc')->get();

        // return view('timeline', compact('posts'));
        return redirect('/top');
    }
}
