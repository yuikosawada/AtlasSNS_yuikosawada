@extends('layouts.login')

@section('content')

{!! Form::open (['url'=>'/search','method'=>'GET']) !!}
{!! Form::hidden('search', 'keyword') !!}


{{Form::label('search','ユーザー名')}}
{{ Form::text('keyword',null,['class'=>'input', 'placeholder' => '検索キーワード']) }}

{{Form::submit('検索')}}
{!! Form::close(); !!}

@if(!empty($keyword))
<p>検索ワード：{{$keyword}}</p>
@endif
<!-- 自分以外の登録ユーザーがすべて表示される -->
@foreach($users as $user)
<tr>
    <td>{{$user->username}}</td>
</tr>
@endforeach

@endsection