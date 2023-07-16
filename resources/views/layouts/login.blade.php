<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <div id="head">
            <h1><a href="/top"><img class="logo" src="images/atlas.png"></a></h1>
            <div id="" class="user">
                <p>{{Auth::user()->username }}さん</p>
                <img class="nav-open active" src="images/arrow.png">
                <!-- 画像が保存される場所：storage/app/public -->
                <!-- 画像を取得する場所：public/storage -->
                <img class="" src="{{asset('storage/image/'.Auth::user()->images)}}" width="25" height="25">


            </div>
            <nav>
                <ul>
                    <li><a href="{{url('/top')}}">HOME</a></li>
                    <li><a href="{{url('/profile')}}">プロフィール編集</a></li>
                    <li><a href="{{url('/logout')}}">ログアウト</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div>
        <div id="side-bar">
            <div id="confirm">
                <p class="auth_username">{{Auth::user()->username }}さんの</p>
                <div class="flex">
                    <p>フォロー数</p>
                    <p>〇〇名</p>
                </div>

                <a href="{{url('/follow-list')}}" class="btn">フォローリスト</a>
                <div class="flex">
                    <p>フォロワー数</p>
                    <p>〇〇名</p>
                </div>
                <a href="{{url('/follower-list')}}" class="btn">フォロワーリスト</a>
            </div>
            <a href="{{url('/search')}}" class="btn">ユーザー検索</a>
        </div>
    </div>
    <footer>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
</body>

</html>