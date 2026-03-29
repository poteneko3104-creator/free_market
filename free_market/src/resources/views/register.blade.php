@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('content')

<div class="content_box">
        <h1 class="content_title">会員登録</h1>
        <form action="/register" method="post">
            @csrf
            <div class="form-group">
                <label for="username">ユーザー名</label>
                <input type="text" id="username" name="name" value="{{old('name')}}">
            </div>
               @if($errors->any('name'))
                    <span class="alert-text">{{$errors->first('name')}}</span>
                @endif

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" value="{{old('email')}}">
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


            <div class="form-group">
                <label for="password_confirmation">確認用パスワード</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="submit-btn">登録する</button>
        </form>
        <div class="login-link">
            <a href="#">ログインはこちら</a>
        </div>
</div>

@endsection