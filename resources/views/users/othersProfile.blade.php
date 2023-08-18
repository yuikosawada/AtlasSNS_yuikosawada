@extends('layouts.login')

@section('content')

<section>
    <div class="others_list flex">
        @foreach($otherUsers as $otherUser)
        <img src="{{asset('storage/image/'.$otherUser->images)}}" class="others_list_img" alt="">
        <div class="others_profile">
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
        <img src="{{asset('storage/image/'.$otherUser->images)}}" class="others_list_archive_img" alt="">

        <!-- 投稿者名・投稿文 -->
        <div class="f-d-column post-archive">
            <p class="post-username">
                {{$otherUser->username}}
            </p>
            <p class="post-article">
                {{ $post->post }}
            </p>
        </div>
        <!--投稿時間 -->
        <div class="flex j-c-spacebetween f-d-column post_tine_btn">
            <p class="post-created_at">
                {{$post->created_at}}
            </p>
        </div>


    </div>

    @endforeach




</section>



@endsection