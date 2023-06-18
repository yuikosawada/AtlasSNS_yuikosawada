@extends('layouts.login')

@section('content')
<!-- <h2>機能を実装していきましょう。</h2> -->
<!-- ここから下編集中 -->
<section>
    <!-- 新規投稿欄 -->
    <div class="new_post p-flexed">
        @if (isset($images)){
        <img src="" alt="">
        } else{
        <img src="" alt="">
        };
        @endif

        {!! Form::open(['url' =>'/posts/store','method'=>'post','files' => true]) !!}
        {!! Form::hidden('id', Auth::id()) !!}


        {{Form::textarea('post_content', null, ['class' => 'post_content', 'id' => 'post_content', 'placeholder' => '投稿内容を入力してください。', 'rows' => '3'])}}
        {{Form::submit('投稿')}}

        @if(session('success'))
        <div class="">
            {{ session('success') }}
        </div>
        @endif
        {!!Form::close();!!}

    </div>

    <!-- 以下タイムライン編集中 -->
    @if(isset($posts))
    <div class="">
        @foreach($posts as $post)
        <div class="">
            <!-- 投稿者アイコン -->
            <img src="{{ asset('storage/profile_image/' .$timeline->user->profile_image) }}" class="rounded-circle" width="50" height="50">

            <!-- 投稿者名・投稿文 -->
            <div class="flex-colum">
                <p>{{$post->user->name}}</p>
                <p>{{$post}}</p>
            </div>
            <!--投稿時間 -->
            <p>
                {{ $post->created_at->format('Y-m-d H:i') }}
            </p>
            <div class="flex">
                <!-- 編集ボタン -->
                <a href="#"><img src="" alt=""></a>
                <!-- 削除ボタン -->
                <a href="#"><img src="" alt=""></a>
            </div>

        </div>
        @endforeach
    </div>
    @endif



</section>

<!-- ここまで -->
@endsection