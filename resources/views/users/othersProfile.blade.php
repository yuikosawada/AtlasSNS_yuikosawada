@extends('layouts.login')

@section('content')

<section>
    <div class="follow-list flex">
        @foreach($otherUsers as $otherUser)
        <img src="{{asset('storage/image/'.$otherUser->images)}}" alt="">
        <div class="">
            <div class="flex">
                <dt>name</dt>
                <dd>{{$otherUser->username}}</dd>
            </div>
            <div class="flex">
                <dt>bio</dt>
                <dd>{{$otherUser->bio}}</dd>
            </div>
        </div>

        @if (auth()->user()->isFollowing($otherUser->id))
        <a href="{{ route('unfollow', ['userId' => $otherUser->id]) }}" class="btn unfollow_btn">フォロー解除</a>
        @else
        <a href="{{ route('follow', ['userId' => $otherUser->id]) }}" class="btn follow_btn">フォローする</a>
        @endif

        @endforeach
    </div>


    @foreach ($otherUser->posts as $post)
    <div class="post flex">
        <!-- 投稿者アイコン -->
        <img src="{{asset('storage/image/'.$otherUser->images)}}" alt="">

        <!-- 投稿者名・投稿文 -->
        <div class="f-d-column">
            <p class="post-username">
                {{$otherUser->username}}
            </p>
            <p class="post-article">
                {{ $post->post }}
            </p>
        </div>
        <!--投稿時間 -->
        <div class="f-d-column">
            <p>
                {{$post->created_at}}
            </p>
        </div>


    </div>

    @endforeach




</section>



@endsection