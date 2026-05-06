@extends('layouts.app')
@section('title')
<title>ログイン</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('content')
<div class="login-container">
     <h1>ログイン</h1>
        <form action="/login" method="post">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email">
            </div>
            @if($errors->any('email'))
                <span class="alert-text">{{$errors->first('email')}}</span>
            @endif
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" id="password" name="password">
            </div>
            @if($errors->any('password'))
                <span class="alert-text">{{$errors->first('password')}}</span>
            @endif
            <button type="submit" class="login-button">ログインする</button>
        </form>
        <div class="register-link">
            <a href="/register">会員登録はこちら</a>
        </div>
</div>
@endsection