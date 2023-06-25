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
                <p>{{Auth::user()->username }}さんの</p>
                <div>
                    <p>フォロー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn"><a href="{{url('/follow-list')}}">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>〇〇名</p>
                </div>
                <p class="btn"><a href="{{url('/follower-list')}}">フォロワーリスト</a></p>
            </div>
            <p class="btn"><a href="{{url('/search')}}">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
</body>

</html>