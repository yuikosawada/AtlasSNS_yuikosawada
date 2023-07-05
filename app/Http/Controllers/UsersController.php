<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\User;
use Auth;
// use phpDocumentor\Reflection\Types\Nullable;
use Validator;


class UsersController extends Controller
{
    //
    // public function profile(){
    //     return view('users.profile');
    // }

    // 検索機能
    public function search_index()
    {
        return view('users.search');
    }

    //検索
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $request->session()->put('keyword', $keyword);
        $keyword = $request->session()->get('keyword');

        dd('keyword');
        // 自分とフォロワーのIDを取得
        $user = auth()->user();
        $followerIds = $user->followers()->pluck('follower_id')->push($user->id);

        // 自分とフォロワーの投稿を取得
        $results = Post::whereIn('user_id', $followerIds)
            ->where(function ($query) use ($keyword) {
                $query->where('title', 'LIKE', "%{$keyword}%")
                    ->orWhere('content', 'LIKE', "%{$keyword}%");
            })
            ->get();
        // 検索結果をビューに渡す
        return view('search', compact('keyword', 'results'));
    }


    // ユーザー登録
    public function create(Request $request)
    {
        $user = $request->input('newUser');
        Post::create(['user' => $user]);
        return redirect('index');
    }

    public function profile()
    {
        return view('users.profile');
    }

    // プロフィール編集
    public function update(Request $request)
    {
        $id = Auth::id();
        $username = $request->input('username');
        $mail = $request->input('mail');
        $bio = $request->input('bio');
        $password = $request->input('password');

        /**
         * 以下のようにデータベースに保存するのは、画像ではなく画像に任意でつけたファイル名ということです。画像を表示するのにヘルパ関数のassetを使うことを前提にしているため。
         * 画像が保存される場所：storage/app/public
         * 画像を取得する場所：public/storage
         */
        if (($request->file('image')) != null) {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'mail' => 'required|string|email|max:255',
                'bio' => 'string|max:150',
                'password' => 'required|string|alpha_num|min:8|max:20|confirmed',
                'password_confirmation' => 'required|string|alpha_num|min:8|max:20',
                'image' => 'image|mimes:jpeg,png,jpg,gif'
            ]);

            $users = Auth::user();
            // storeAsを使用すればファイル名画暗号みたいにならずにそのままのファイル名になる
            $filename = $request->file('image')->getClientOriginalName();

            $image_path = $request->file('image')->storeAs('public/image', $filename);
            // // 上記処理にて保存した画像に名前を付け、usersテーブルのimagesカラムに格納
            $users->images = basename($image_path);
            $users->username = $username;
            $users->mail = $mail;
            $users->password = bcrypt($password);
            $users->bio = $bio;
            $users->save();
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        } else {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255',
                'mail' => 'required|string|email|max:255',
                'bio' => 'string|max:150',
                'password' => 'required|string|alpha_num|min:8|max:20|confirmed',
                'password_confirmation' => 'required|string|alpha_num|min:8|max:20',
                'images' => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        };

        return redirect('/top');
    }
}
