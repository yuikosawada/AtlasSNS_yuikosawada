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
        // キーワードを定義
        $keyword = $request->input('keyword');
        $query = User::query();
        // もしキーワードが入力されてたら
        if (!empty($keyword)) {
            // $query->where('username', 'like', '%' . $keyword . '%')->where('id', '!=', Auth::id())->get();
            $query->where('username', 'like', '%' . $keyword . '%')
            ->where('username', '!=', Auth::user()->username)
            ->get();
            $users = $query->get();
     
            return view('users.search', [
                'users' => $users,
                'keyword' => $keyword,
            ]);
            // もし入力されてなかったら全て表示
        } else {
            $users = User::where('id', '!=', Auth::id())
            ->where('username', '!=', Auth::user()->username)
            ->get();
            return view('users.search', [
                'users' => $users,
            ]);
        }
    }
}
