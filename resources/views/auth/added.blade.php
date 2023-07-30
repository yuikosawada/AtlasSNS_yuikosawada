@extends('layouts.logout')

@section('content')

<div id="clear" class="added-card">
  <h2 class="added-username">{{ session('username') }}さん</h2>
  <p class="added-welcome">ようこそ！AtlasSNSへ！</p>
  <p class="t-a-center mb20">ユーザー登録が完了いたしました。</p>
  <p class="t-a-center mb20">早速ログインをしてみましょう！</p>

  <p><a href="/login" class="to-login-btn">ログイン画面へ</a></p>
</div>

@endsection