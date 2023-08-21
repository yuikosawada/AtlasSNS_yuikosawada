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
    {

        $loggedInUserId = auth()->user()->id;
        // 自分にフォローされてるユーザーたち（フォローしてる人たち）
        $followedIds = Follow::where('following_id', $loggedInUserId)->pluck('followed_id');
        $follows = User::whereIn('id', $followedIds)->get();

        // FollowsテーブルとPostsテーブルの結合クエリを作成
        $followsPostsQuery = Follow::join('posts', 'follows.followed_id', '=', 'posts.user_id')
            ->join('users', 'follows.followed_id', '=', 'users.id')
            ->where('follows.following_id', $loggedInUserId)
            ->select('posts.*', 'users.*');


        // 結合した結果を取得
        $posts = $followsPostsQuery->get();

        return view('posts.index')->with(['follows' => $follows, 'posts' => $posts]);
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
