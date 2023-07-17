<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Follow;
use App\User;
use Auth;


class FollowsController extends Controller
{

    // public function show($user)
    // {
    //     // 自分のユーザーIDを取得
    //     $loggedInUserId = auth()->user()->id;
    //     // すでにフォローしているユーザーを取得
    //     $followedUser = $user; // 修正点: $user をそのまま使用する
    //     $followedUserId = $followedUser->id;

    //     // すでにフォローしている状態
    //     $isFollow = Follow::where([
    //         'following_id' => $loggedInUserId,
    //         'followed_id' => $followedUserId,
    //     ])->exists(); // 修正点: exists() メソッドを使用して結果をブール値として取得

    //     return redirect('/search');
    // }



    //フォローする
    // public function follow(User $user, $userId)
    // {
    //     // 自分のユーザーIDを取得
    //     $loggedInUser = auth()->user();
    //     $loggedInUserId = auth()->user()->id;
    //     // フォローしたい人のユーザーIDを元にユーザーを取得
    //     $followedUser = User::find($userId);
    //     $followedUserId = $followedUser->id;
    //     // フォローしているか
    //     $is_following = $loggedInUser->isFollowing($user->id);
    //     if (!$is_following) {
    //         // フォローしていなければフォローする
    //         // フォローデータをデータベースに登録
    //         Follow::create([
    //             'following_id' => $loggedInUserId,
    //             'followed_id' => $followedUserId,
    //         ]);
    //     }

    //     return back(); // フォロー後に元のページにリダイレクト
    // }

    //フォロー解除
    // public function unfollow(User $user, $userId)
    // {
    //     $loggedInUser = auth()->user();
    //     $loggedInUserId = auth()->user()->id;
    //     // フォローしているか
    //     $is_following = $loggedInUser->isFollowing($user->id);
    //     if ($is_following) {
    //         // フォローしていればフォローを解除する
    //         Follow::where([
    //             ['followed_id', '=', $userId],
    //             ['following_id', '=', $loggedInUserId],
    //         ])
    //             ->delete();
    //     }
    //     return back();
    // }
}
