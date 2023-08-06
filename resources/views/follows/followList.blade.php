@extends('layouts.login')

@section('content')

<section>
    <div class="follow-list ">
        @foreach($follows as $follow)
        <a href="/post/{{$follow->id}}">
            <img src="{{asset('storage/image/'.$follow->images)}}" alt=""></a>
        @endforeach
    </div>


    @foreach($followingPosts as $followingPost)
    <div class="post flex">
        <!-- 投稿者アイコン -->
        <a href="/post/{{$followingPost->user_id}}"><img src="{{asset('storage/image/'.$followingPost->images)}}" alt=""></a>

        <!-- 投稿者名・投稿文 -->
        <div class="f-d-column">
            <p class="post-username">
                {{$followingPost->username}}
            </p>
            <p class="post-article">
                {{$followingPost->post}}
            </p>
        </div>
        <!--投稿時間 -->
        <div class="f-d-column">
            <p>
                {{$followingPost->created_at}}
            </p>
        </div>


    </div>

    @endforeach




</section>



@endsection