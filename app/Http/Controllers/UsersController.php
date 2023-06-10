<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class UsersController extends Controller
{
    //
    // public function profile(){
    //     return view('users.profile');
    // }
    public function search()
    {
        return view('users.search');
    }
    public function create(Request $request)
    {
        $user = $request->input('newUser');
        Post::create(['user' => $user]);
        return redirect('index');
    }



    // ここから下編集中

    public function update(Request $request)
    {
        $user = Auth::user();
        // $image = $request->file('iconimage');
        //ファイルが送信されたか確認
        if ($request->hasFile('image')) { //バリデーションでチェックするなら、ここは無くてもいいかも
            //アップロードに成功しているか確認
            if ($request->file('image')->isValid()) {
                $image = $request->file('iconimage')->store('public/images');
            }
        };
        

        $user->update([
            'username' => $request->input('username'),
            'mail' => $request->input('mail'),
            'password' => bcrypt($request->input('password')),
            'bio' => $request->input('bio'),
            'images' => basename($image),
        ]);
    }
}
