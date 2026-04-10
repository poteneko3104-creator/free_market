@extends('layouts.app')

@section('title')
<title>プロフィール</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/mypage.css')}}">
@endsection


@section('content')
<div class="container">
     <section class="profile-section">
            <div class="profile-info">
                <img class="profile-icon" src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('images/default-icon.png') }}"  alt="">
                <!--<div class="profile-icon"></div>-->
                <h1 class="user-name">{{$user->name}}</h1>
            </div>
            <a href="/mypage/profile" class="btn-edit">プロフィールを編集</a>
            <!--<button class="btn-edit">プロフィールを編集</button>-->
        </section>

        <!-- タブ切り替え -->
        <div class="tabs">
            <a href="{{ route('mypage', ['tab' => 'sold']) }}" class="tab">出品した商品</a>
            <a href="{{ route('mypage', ['tab' => 'bought']) }}" class="tab">購入した商品</a>
        </div>

        <!-- 商品一覧 -->
        <div class="product-grid">
            @foreach($items as $item)
                <div class="product-card">
                    <img src="{{$item->pic}}" class="product-image" alt="">
                    <!--<div class="product-image">商品画像</div>-->
                    <p class="product-title">{{$item->name}}</p>
                </div>
            @endforeach

        </div>
</div>
@endsection