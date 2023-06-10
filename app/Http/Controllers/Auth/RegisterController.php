<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
// Validationを使う
use Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        // Postの処理
        if ($request->isMethod('post')) {
            $data = $request->input();
            $rules = [
                //バリデーションルール
                'username' => 'required|min:2|max:12',
                'mail' => 'required|string|email|min:5|max:40|unique:users',
                'password' => 'required|string|alpha_num|min:8|max:20|confirmed',
                'password_confirmation' => 'required|string|alpha_num|min:8|max:20'
            ];
            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect('/register')
                    ->withErrors($validator)
                    ->withInput();
            }

            // User::create($data);
            // $this->create($data);
            // $user=$request->session() ->get('username');
            // return redirect('added')->with('username',$user);

            // 新規登録後にユーザー名を表示せるために変更
            $username = User::create($data);
            $user = $request->get('username');
            return redirect('added')->with('username', $user);
        }

        return view('auth.register');
    }


    public function added()
    {
        return view('auth.added');
    }
}
