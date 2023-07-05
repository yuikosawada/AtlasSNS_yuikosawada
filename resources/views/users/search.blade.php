@extends('layouts.login')

@section('content')

{!! Form::open (['url'=>'/search','method'=>'GET']) !!}
{!! Form::hidden('search', 'keyword') !!}


{{Form::label('search','ユーザー名')}}
{{ Form::text('keyword', old('keyword'), ['placeholder' => '検索キーワード']) }}
<input type="text" name="keyword" value="{{ old('keyword') }}" />


{{Form::submit('検索')}}
{!! Form::close(); !!}


<!-- 自分以外の登録ユーザーがすべて表示される -->



@endsection