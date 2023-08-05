@extends('layouts.login')

@section('content')

<section>
    <div class="follow-list ">
        @foreach($followers as $follower)
        <img src="{{asset('storage/image/'.$follower->images)}}" alt="">
        @endforeach
    </div>


    @foreach($followerPosts as $followerPost)
    <div class="post flex">
        <!-- 投稿者アイコン -->
        <img src="{{asset('storage/image/'.$followerPost->images)}}" alt="">

        <!-- 投稿者名・投稿文 -->
        <div class="f-d-column">
            <p class="post-username">
                {{$followerPost->username}}
            </p>
            <p class="post-article">
                {{$followerPost->post}}
            </p>
        </div>
        <!--投稿時間 -->
        <div class="f-d-column">
            <p>
                {{$followerPost->created_at}}
            </p>
        </div>


    </div>

    @endforeach




</section>



@endsection