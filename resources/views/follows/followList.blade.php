@extends('layouts.login')

@section('content')

<section>
    <div class="flex follow_list">
        <h2>Follow List</h2>

        @foreach($follows as $follow)
        <a href="/post/{{$follow->id}}">
            @if($follow->images == 'no-image.png')
            <img src="{{asset('images/no-image.png')}}" class="icon follow_list_img">
            @else
            <img src="{{asset('storage/image/'.$follow->images)}}" class="follow_list_img" alt="">
            @endif

        </a>
        @endforeach
    </div>


    @foreach($followingPosts as $followingPost)
    <div class="post flex">

        <!-- 投稿者アイコン -->
        <a href="/post/{{$followingPost->user_id}}">
            @if($followingPost->images == 'no-image.png')
            <img src="{{asset('images/no-image.png')}}" class="icon">
            @else
            <img src="{{asset('storage/image/'.$followingPost->images)}}" class="follow_list_archive_img" alt="">
            @endif

        </a>

        <!-- 投稿者名・投稿文 -->
        <div class="f-d-column post-archive">
            <p class="post-username">
                {{$followingPost->username}}
            </p>
            <p class="post-article">
                {{$followingPost->post}}
            </p>
        </div>
        <!--投稿時間 -->
        <div class="flex j-c-spacebetween f-d-column post_tine_btn">
            <p class="post-created_at">
                {{$followingPost->created_at}}
            </p>
        </div>


    </div>

    @endforeach




</section>



@endsection