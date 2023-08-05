<?php

namespace App\Http\Controllers;


use App\Follow;
use App\User;


class FollowsController extends Controller
{
    //フォローする
    public function follow($userId)
    {
        // フォローしているか
        $follower = auth()->user();
        $is_following = $follower->isFollowing($userId);

        // フォローしていなかったら下記のフォロー処理を実行
        if (!$is_following) {
            // 自分のユーザーIDを取得
            $loggedInUserId = auth()->user()->id;
            // フォローしたい人のユーザーIDを元にユーザーを取得
            $followedUser = User::find($userId);
            $followedUserId = $followedUser->id;

            // フォローデータをデータベースに登録
            Follow::create([
                'following_id' => $loggedInUserId,
                'followed_id' => $followedUserId,
            ]);

            return redirect('/search'); // フォロー後に元のページにリダイレクト
        }
    }

    //フォロー解除
    public function unfollow($userId)
    {
        // フォローしているか
        $follower = auth()->user();
        $is_following = $follower->isFollowing($userId);

        // フォローしていれば下記のフォロー解除を実行する
        if ($is_following) {

            $loggedInUserId = auth()->user()->id;
            Follow::where([
                ['followed_id', '=', $userId],
                ['following_id', '=', $loggedInUserId],
            ])
                ->delete();
        }
        return redirect('/search');
    }

    // フォローリスト
    public function followList_show()
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
        $followingPosts = $followsPostsQuery->get();

        return view('follows.followList')->with(['follows' => $follows, 'followingPosts' => $followingPosts]);
    }

    // フォロワーリスト
    public function followerList_show()
    {
        $loggedInUserId = auth()->user()->id;
        // フォローしてくれてるユーザーたち（フォロワーたち）
        $followerIds = Follow::where('followed_id', $loggedInUserId)->pluck('following_id');
        $followers = User::whereIn('id', $followerIds)->get();
        // dd($followers);
        // FollowsテーブルとPostsテーブルの結合クエリを作成
        $followersPostsQuery = Follow::join('posts', 'follows.following_id', '=', 'posts.user_id')
            ->join('users', 'follows.following_id', '=', 'users.id')
            ->where('follows.followed_id', $loggedInUserId)
            ->select('posts.*', 'users.*');

        // 結合した結果を取得
        $followerPosts = $followersPostsQuery->get();


        return view('follows.followerList')->with(['followers' => $followers, 'followerPosts' => $followerPosts]);
    }
}
