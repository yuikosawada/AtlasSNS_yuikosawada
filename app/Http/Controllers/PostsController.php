<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use App\Post;
use App\User;
// use App\Follow;
// use Illuminate\Support\Facades\Auth;
use Auth;

class PostsController extends Controller
{
    // 投稿一覧表示
    public function index(Post $posts)
    {
        // postsフォルダのindex.bladeを表示
        $posts = User::select('users.username', 'users.images', 'posts.id', 'posts.user_id', 'posts.post', 'posts.created_at')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
    }

    // 新規投稿
    public function store_post(Request $request)
    {
        // 新規投稿の保存
        $post = new Post();
        $data = Post::create([
            'post' => $request->input('new_post_content'),
            'user_id' => Auth::id(),
        ]);
        return redirect('/top');
    }

    // 投稿削除
    public function delete_post($id)
    {
        Post::where('id', $id)->delete();

        return redirect('/top');
    }


    // 投稿編集
    public function update_post(Request $request)
    {
        $id = $request->input('post_id');
        $newPost = $request->input('text');
        Post::where('id', $id)
            ->update(
                ['post' => $newPost]
            );

        return redirect('/top');
    }
}
