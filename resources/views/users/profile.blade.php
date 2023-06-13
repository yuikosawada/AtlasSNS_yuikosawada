@extends('layouts.login')

@section('content')


{!! Form::open(['url' =>'/profile/update','method'=>'post','files' => true]) !!}
{!! Form::hidden('id', Auth::id()) !!}

<!-- {{ Form::text('inputタグのname属性', 'value属性デフォルト値', ['id' => 'id'])}} -->
<tr>
    <td>{{Form::label('username','ユーザー名')}}
        {{Form::text('username',Auth::user()->username ,['class'=>'input'])}}
    </td>
    <td>{{Form::label('mail','メールアドレス')}}
        {{Form::text('mail',Auth::user()->mail ,['class'=>'input'])}}
    </td>
    <td>{{Form::label('password','パスワード')}}
        {{Form::text('password', null,['class'=>'input'])}}
    </td>
    <td>{{Form::label('password_confirmation','パスワード確認')}}
        {{Form::text('password_confirmation',null,['class'=>'input'])}}
    </td>
    <td>{{Form::label('bio','自己紹介')}}
        {{Form::text('bio',Auth::user()->bio,['class'=>'input'])}}
    </td>
    <td>
        {{Form::label('image','アイコン')}}
        {{Form::file('images',['class'=>'input','id'=>'images'])}}
    </td>
    <td>
        {{Form::submit('更新')}}
    </td>
</tr>
@if($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

{!!Form::close();!!}
@endsection