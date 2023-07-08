@extends('layouts.login')

@section('content')
<!-- <h2>機能を実装していきましょう。</h2> -->
<!-- ここから下編集中 -->
<section>
    <!-- 新規投稿欄 -->
    <div class="new_post p-flexed">
        @if (isset($images)){
        <img class="" src="{{asset('storage/image/'.Auth::user()->images)}}" width="25" height="25"> } else{
        <img src="{{asset('storage/image/icon6.png')}}" alt="">
        };
        @endif

        {!! Form::open(['url' =>'/posts','method'=>'post']) !!}
        {!! Form::hidden('user_id', 'post') !!}


        {{Form::textarea('post_content', null, ['class' => 'post_content', 'id' => 'post_content', 'placeholder' => '投稿内容を入力してください。', 'rows' => '3'])}}
        {{Form::submit('投稿')}}


        {!!Form::close();!!}

    </div>


    <!-- 以下タイムライン編集中 -->
    <div class="">
        @foreach($posts as $post)
        <div class="">
            <!-- 投稿者アイコン -->


            <!-- 投稿者名・投稿文 -->
            <div class="flex-colum">
                <p>{{$post->name}}</p>
                <p>{{$post->username}}</p>
                <p> {!! nl2br(e($post->post)) !!}
                </p>
            </div>
            <!--投稿時間 -->
            <p>
                {{ $post->created_at->format('Y-m-d H:i') }}
            </p>
            <div class="archives flex">
                <!-- 編集ボタン -->
                <!-- <a href="/post/{{$post->id}}/update"><img src="images/edit.png" alt="投稿編集"></a> -->
                <a href="" post="{{$post->post}}" post_id="{{$post->id}}"><img src="images/edit.png" alt="投稿編集"></a>
                <!-- 削除ボタン -->
                <a href="/post/{{$post->id}}/deleat" onclick="return comfirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="images/trash-h.png" alt="投稿削除"></a>
            </div>

        </div>
        @endforeach
    </div>



</section>

<!-- ここまで -->
@endsection