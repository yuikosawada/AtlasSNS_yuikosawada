<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
// use phpDocumentor\Reflection\Types\Nullable;
use Validator;
use App\User;



class UsersController extends Controller
{

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



    // //フォローする
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

    // //フォロー解除
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




    // フォロー
    public function follow(User $user)
    {
        
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if (!$is_following) {
            // フォローしていなければフォローする
            $follower->follow($user->id);
            return back();
        }
    }

    // フォロー解除
    public function unfollow(User $user)
    {
        $follower = auth()->user();
        // フォローしているか
        $is_following = $follower->isFollowing($user->id);
        if ($is_following) {
            // フォローしていればフォローを解除する
            $follower->unfollow($user->id);
            return back();
        }
    }
}
