@extends('layouts.login')

@section('content')


{!! Form::open(['url' =>'/profile/update','files' => true, 'class'=>'profile_form']) !!}
{!! Form::hidden('id', Auth::id()) !!}

<!-- {{ Form::text('inputタグのname属性', 'value属性デフォルト値', ['id' => 'id'])}} -->

<div class="flex">
    <img class="profile_form_img" src="{{asset('storage/image/'.Auth::user()->images)}}" width="50" height="50">

    <div class="profile_form_contents">
        <div class="profile_form_content">{{Form::label('username','user name')}}
            {{Form::text('username',Auth::user()->username ,['class'=>'input'])}}
        </div>
        <div class="profile_form_content">
            {{Form::label('mail','mail adress')}}
            {{Form::text('mail',Auth::user()->mail ,['class'=>'input'])}}
        </div>
        <div class="profile_form_content">
            {{Form::label('password','password')}}
            {{Form::password('password', null,['class'=>'input'])}}
        </div>
        <div class="profile_form_content">
            {{Form::label('password_confirmation','password comfirm')}}
            {{Form::password('password_confirmation',null,['class'=>'input'])}}
        </div>
        <div class="profile_form_content">
            {{Form::label('bio','bio')}}
            {{Form::text('bio',Auth::user()->bio,['class'=>'input'])}}
        </div>
        <div class="profile_form_content">
            {{Form::label('image','icon image')}}
            {{Form::file('image',['class'=>'input'])}}
        </div>
        {{Form::submit('更新')}}
    </div>
</div>
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