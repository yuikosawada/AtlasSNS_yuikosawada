<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Follow;
use App\User;
use Auth;


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
        $followedIds = Follow::where('following_id', $loggedInUserId)->pluck('followed_id');
        $follows = User::whereIn('id',$followedIds)->get();
        $posts = Post::whereIn('user_id', $followedIds)->get();
        $datas = $posts->concat($follows);

        // dd($follows);


        // return view('follows.followList')->with(['datas' => $datas]);
        return view('follows.followList')->with(['follows' => $follows, 'posts'=>$posts]);
    }

    public function followList($userId)
    {
        // フォローしているか
        // $follower = auth()->user();
        // $is_following = $follower->isFollowing($userId);

        //     // フォローしていなかったら下記のフォロー処理を実行
        //     if ($is_following) {
        //         $follows = $is_following->user();
        //         $posts = $is_following->user();
        //     }
        //     return redirect('/follow-list', compact('posts', 'follows')); // フォロー後に元のページにリダイレクト
        $follows = Follow::where([
            ['followed_id', '=', $userId],
            ['following_id', '=', $loggedInUserId],
        ])->get();
    }
}
