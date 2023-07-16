<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;

use Auth;

class SearchController extends Controller
{
    //検索機能
    public function search_index()
    {
        return view('users.search');
    }


    public function search(Request $request)
    {
        // 自分のユーザーIDを取得
        $loggedInUserId = auth()->user()->id;
        // すでにフォローしているユーザーを取得
        $query = User::query();
        $users = $query->get();
        foreach ($users as $user) {
            $followedUserId = $user->id;
        }
        // すでにフォローしている状態
        $isFollow = Follow::where([
            'following_id' => $loggedInUserId,
            'followed_id' => $followedUserId,
        ])->exists(); // 修正点: exists() メソッドを使用して結果をブール値として取得



        // キーワードを定義
        $keyword = $request->input('keyword');
        $query = User::query();
        // もしキーワードが入力されてたら
        if (!empty($keyword)) {
            $query->where('username', 'like', '%' . $keyword . '%')->where('id', '!=', Auth::id())->get();
            $users = $query->get();
            return view('users.search', [
                'users' => $users,
                'keyword' => $keyword,
                'isFollow' => $isFollow
            ]);
            // もし入力されてなかったら全て表示
        } else {
            $users = User::where('id', '!=', Auth::id())->get();
            return view('users.search', [
                'users' => $users,
                'isFollow' => $isFollow
            ]);
        }
    }
}
