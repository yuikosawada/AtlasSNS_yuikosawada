@extends('layouts.logout')

@section('content')
<!-- 適切なURLを入力してください -->
{!! Form::open(['url' => '/login', 'class'=>'login-form']) !!}

<h2 class="login-welcome">AtlasSNSへようこそ</h2>

<div class="login-form-mail">
    {{ Form::label('e-mail','mail adress') }}<br>
    {{ Form::text('mail',null,['class' => 'input']) }}
</div>

<div class="login-form-pw">
    {{ Form::label('password','password') }}<br>
    {{ Form::password('password',['class' => 'input']) }}
</div>

{{ Form::submit('LOGIN',['class'=>'login-btn']) }}

<a href="/register" class="to-register">新規ユーザーの方はこちら</a>

{!! Form::close() !!}

@endsection
