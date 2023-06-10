@extends('layouts.login')

@section('content')


{{!! Form::open(['url' =>'/profile/{id}/update','method'=>'post','files' => true]) !!}}
{{!! Form::hidden('id', $auth->id) !!}}

<tr>
    <td>{{Form:label('username','user name')}}
        {{Form:text('username',$auth->username ,['class'=>'input'])}}
    </td>
    <td>{{Form:label('mail','mail')}}
        {{Form:text('mail',$auth->mail ,['class'=>'input'])}}
    </td>
    <td>{{Form:label('password','password')}}
        {{Form:text('password',['class'=>'input'])}}
    </td>
    <td>{{Form:label('password_confirm','password confirm')}}
        {{Form:text('password_confirm',$auth->password ,['class'=>'input'])}}
    </td>
    <td>{{Form:label('bio','bio')}}
        {{Form:text('bio',$auth->bio ,['class'=>'input'])}}
    </td>
    <td>{{Form:label('image','image')}}
        {{Form:file('image',['class'=>'input','id'=>'iconimage'])}}
    </td>
    <td>
        {{Form::submit('更新')}}
    </td>
</tr>

{{!!Form::close();!!}}
@endsection