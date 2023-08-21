@extends('layouts.login')

@section('content')

{!! Form::open (['url'=>'/search','method'=>'GET','class'=>'search_container']) !!}
{!! Form::hidden('search', 'keyword') !!}

{{ Form::text('keyword',null,['class'=>'input search_box', 'placeholder' => 'ユーザー名']) }}

{!!Form::image('images/search.png','検索',['class'=>'search_button'])!!}
@if(!empty($keyword))
<p class="keyword">検索ワード：{{$keyword}}</p>
@endif

{!! Form::close(); !!}


<!-- 自分以外の登録ユーザーがすべて表示される -->
@foreach($users as $user)
<div class="search_post">
    <div class="flex">
        <img src="{{asset('storage/image/'.$user->images)}}" width="40" height="40" alt="">
        <p class="search_post_username">{{$user->username}}</p>
    </div>
    @if (auth()->user()->isFollowing($user->id))
    <a href="{{ route('unfollow', ['userId' => $user->id]) }}" class="btn unfollow_btn">フォロー解除</a>
    @else
    <a href="{{ route('follow', ['userId' => $user->id]) }}" class="btn follow_btn">フォローする</a>
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