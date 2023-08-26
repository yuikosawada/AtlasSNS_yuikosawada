<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use App\Post;
use App\User;
use App\Follow;
// use Illuminate\Support\Facades\Auth;
use Auth;

class PostsController extends Controller
{
    // 投稿一覧表示
    public function index(Post $posts)
    {   // postsフォルダのindex.bladeを表示
        // ログイン中のユーザーのIDを取得
        $loggedInUserId = auth()->user()->id;
        // フォローしているユーザーのIDを取得
        $followingUserIds = Follow::where('following_id', $loggedInUserId)->pluck('followed_id');
        // 自分のユーザーIDも追加
        $followingUserIds[] = $loggedInUserId;
        // フォローしているユーザーと自分のユーザーIDに関連する投稿とユーザー情報を取得
        $posts = Post::with('user')
            ->whereIn('user_id', $followingUserIds)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('posts.index', compact('posts'));
    }

    // 新規投稿
    public function store_post(Request $request)
    {
        // 新規投稿の保存
        $newPost = $request->input('new_post_content');
        if ($newPost) {
            Post::create([
                'post' => $request->input('new_post_content'),
                'user_id' => Auth::id(),
            ]);
        }
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



    // 相手のプロフィール＆投稿一覧
    public function othersProfile($user_id)
    {
        $otherUsers =  User::with('posts')->where('id', $user_id)->get();

        return view('users.othersProfile', compact('otherUsers'));
    }
}
