@extends('layouts.login')

@section('content')
<!-- <h2>機能を実装していきましょう。</h2> -->
<!-- ここから下編集中 -->
<section>
    <!-- 新規投稿欄 -->
    <div class="new_post p-flexed">

        <img class="" src="{{asset('storage/image/'.Auth::user()->images)}}" width="50" height="50">

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
                <p>{{$post->username}}</p>
                <p> {!! nl2br(e($post->post)) !!}
                </p>
            </div>
            <!--投稿時間 -->
            <p>
                {{ $post->created_at->format('Y-m-d H:i') }}
            </p>
            @if(!($othersPost))
            <div class="archives flex">
                <!-- 編集ボタン -->
                <a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}">
                    <img src="images/edit.png" alt="投稿編集">
                </a>
                <!-- モーダルの中身 -->
                <div class="modal js-modal">
                    <div class="modal__bg js-modal-close"></div>
                    <div class="modal__content">
                        <form action="/post/update" method="post">
                            <textarea name="text" class="modal_post"></textarea>
                            <input type="hidden" name="post_id" class="modal_id" value="">
                            <input type="submit" value="更新">
                            {{ csrf_field() }}
                        </form>
                        <a class="js-modal-close" href="">閉じる</a>
                    </div>
                </div>


                <!-- 削除ボタン -->
                <a href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの本を削除してもよろしいでしょうか？')" post="{{ $post->post }}" post_id="{{ $post->id }}"><img src="images/trash-h.png" alt="投稿削除"></a>
            </div>
            @endif
            

        </div>
        @endforeach
    </div>


</section>

<!-- ここまで -->
@endsection