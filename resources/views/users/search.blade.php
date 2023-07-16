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
<div class="search_post">
    <img src="{{asset('storage/image/'.$user->images)}}" width="40" height="40" alt="">
    <p class="search_post_username">{{$user->username}}</p>

    @if(!($isFollow))
    <a href="{{ route('follow', ['userId' => $user->id]) }}" class="btn follow_btn">フォローする</a>
    @else
    <a href="{{ route('unfollow', ['userId' => $user->id]) }}" class="btn unfollow_btn">フォロー解除</a>
    @endif

</div>
@endforeach

@if(!empty($follows))
<div class="follow_list">
    @foreach($follows as $follow)
    <p>{{$follow->username}}</p>
    @endforeach
</div>
@endif

@endsection