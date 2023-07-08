<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
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
        // 1つ目の処理
        $keyword = $request->input('keyword');
        $query = User::query();
        // 2つ目の処理
        if (!empty($keyword)) {
            $query->where('username', 'like', '%' . $keyword . '%')->where('id', '!=', Auth::id())->get();
            $users = $query->get();
            return view('users.search', [
                'users' => $users,
                'keyword' => $keyword
            ]);
        } else {
            $users = User::where('id', '!=', Auth::id())->get();
            return view('users.search', ['users' => $users]);
        }
    }

}
