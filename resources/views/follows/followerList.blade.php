@extends('layouts.login')

@section('content')

<section>
    <div class="flex follower_list">
    <h2>Follower List</h2>
        @foreach($followers as $follower)
        <a href="/post/{{$follower->id}}">
            <img src="{{asset('storage/image/'.$follower->images)}}" class="follower_list_img" alt=""></a>
        @endforeach
    </div>


    @foreach($followerPosts as $followerPost)
    <div class="post flex">
        <!-- 投稿者アイコン -->
        <a href="/post/{{$followerPost->user_id}}">
            <img src="{{asset('storage/image/'.$followerPost->images)}}" class="follower_list_archive_img" alt="">
        </a>

        <!-- 投稿者名・投稿文 -->
        <div class="f-d-column post-archive">
            <p class="post-username">
                {{$followerPost->username}}
            </p>
            <p class="post-article">
                {{$followerPost->post}}
            </p>
        </div>
        <!--投稿時間 -->
        <div class="flex j-c-spacebetween f-d-column post_tine_btn">
            <p class="post-created_at">
                {{$followerPost->created_at}}
            </p>
        </div>


    </div>

    @endforeach




</section>



@endsection