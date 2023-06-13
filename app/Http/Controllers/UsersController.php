<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;


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

    public function profile()
    {
        return view('users.profile');
    }

    // ここから下編集中

    public function update(Request $request)
    {
        $id = Auth::id();
        $username = $request->input('username');
        $mail = $request->input('mail');
        $bio = $request->input('bio');
        $password = $request->input('password');
        // imagesフィールドにアップロードされた画像をpublic/imagesに保存する
        $images = $request->file('images');

        // $validator = Validator::make($request->all(), $rules);
        // if ($validator->fails()) {
        //     return redirect('/register')
        //             ->withErrors($validator)
        //             ->withInput();


        // }


        $this->validate($request, [
            'username' => 'required|string|max:255',
            'mail' => 'required|string|email|max:255',
            'bio' => 'string|max:150',
            'password' => 'required|string|alpha_num|min:8|max:20|confirmed',
            'password_confirmation' => 'required|string|alpha_num|min:8|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif'
        ]);
        // if ($request->hasFile('image')) {
        //     $images->store('public/images');
        // } elseif ($validator->fails()) {
        //     return redirect('/profile')->withErrors($validator)->withInput();
        // };

        User::where('id', $id)->update([
            'username' => $username,
            'mail' => $mail,
            'bio' => $bio,
            'password' => $password,
            'images' => $images,
        ]);
        return redirect('/top');
    }
}
