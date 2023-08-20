@extends('layouts.logout')

@section('content')

@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<!-- 適切なURLを入力してください -->
<!-- action属性でどこに送るかをファザードバージョンで記述 -->
{!! Form::open(['url' => '/register','class'=>'register-form']) !!}

<h2 class="register-welcome">新規ユーザー登録</h2>

<div class="register-form-username">
    {{ Form::label('ユーザー名','user name') }}
    {{ Form::text('username',null,['class' => 'input']) }}
</div>

<div class="register-form-mail">
    {{ Form::label('メールアドレス','mail adress') }}
    {{ Form::text('mail',null,['class' => 'input']) }}
</div>

<div class="register-form-pw">
    {{ Form::label('パスワード','password') }}
    {{ Form::password('password',null,['class' => 'input']) }}
</div>

<div class="register-form-pw">
    {{ Form::label('パスワード確認','password comfirm') }}
    {{ Form::password('password_confirmation',null,['class' => 'input']) }}
</div>

{{ Form::submit('REGISTER',['class'=>'register-btn']) }}

<p><a href="/login" class="to-login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection