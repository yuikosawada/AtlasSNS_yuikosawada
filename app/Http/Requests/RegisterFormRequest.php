<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //バリデーションルール
            'username' => 'required|min:2|max:12',
            'mail' => 'required|min:5|max:40',
            'password' => 'required|alpha_desh|min:8|max:20',
            'password_confirmation' => 'required|alpha_desh|min:8|max:20|same:password'
        ];
    }

    public function error_messages(){
        return[
            'username_required' =>'ユーザー名は入力必須です。',
            'username_min' =>'ユーザー名は2文字以上で入力して下さい。',
            'username_max' =>'ユーザー名は2文字以下で入力して下さい。',

            'mail_required' =>'メールアドレスは入力必須です。',
            'mail_min' =>'メールアドレスは5文字以上で入力して下さい。',
            'mail_max' =>'メールアドレスは40文字以下で入力して下さい。',
            
            'password_required' =>'パスワードは入力必須です。',
            'password_min' =>'パスワードは8文字以上で入力して下さい。',
            'password_max' =>'パスワードは20文字以下で入力して下さい。',
            'password_confirmation'=>'パスワードが一致しません。'
        ];
    } 
}
