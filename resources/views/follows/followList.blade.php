@extends('layouts.login')

@section('content')

<section>
    <div class="follow-list ">
        @foreach($follows as $follow)
    <img src="{{asset('storage/image/'.$follow->images)}}" alt="">
    @endforeach
    </div>


    @foreach($posts as $post)
    <div class="post flex">
        <!-- 投稿者アイコン -->


        <!-- 投稿者名・投稿文 -->
        <div class="f-d-column">
            <p class="post-username">
            {{$post->username}}
            </p>
            <p class="post-article">
                {{$post->post}}
            </p>
        </div>
        <!--投稿時間 -->
        <div class="f-d-column">
            <p>
                投稿時間
            </p>
        </div>


    </div>

    @endforeach




</section>



@endsection