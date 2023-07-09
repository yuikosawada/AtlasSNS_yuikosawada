@extends('layouts.login')

@section('content')

<section>
    <!-- foreach($follows as $follow) -->
    <div class="follow-list">
    </div>
    <!-- endforeach -->


    @foreach($posts as $post)
    <div class="post flex">
        <!-- 投稿者アイコン -->


        <!-- 投稿者名・投稿文 -->
        <div class="f-d-column">
            <p class="post-username">{{$post->users->username}}</p>
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