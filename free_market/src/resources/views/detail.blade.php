@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/detail.css')}}">
@endsection


@section('content')

<div class="container">
     <div class="product-layout">
            <!-- 左側：商品画像 -->
            <div class="product-image">
                @if(!empty($item->pic))
                <img src="{{$item->pic}}" alt="画像がありません">
                @endif
            </div>

            <!-- 右側：商品情報 -->
            <div class="product-details">
                <h1 class="product-title">{{$item->name}}</h1>
                <p class="brand-name">{{$item->brand}}</p>
                <div class="price">¥{{$item->price}} <span>(税込)</span></div>
                
                <div class="stats">
                    <div class="stat-item">♡ <span>3</span></div>
                    <div class="stat-item">💬 <span>1</span></div>
                </div>

                <a href="#" class="btn-purchase">購入手続きへ</a>

                <section class="section">
                    <h2 class="section-title">商品説明</h2>
                    <p>{{$item->detail}}</p>
                </section>

                <section class="section">
                    <h2 class="section-title">商品の情報</h2>
                    <div class="info-row">
                        <span class="info-label">カテゴリー</span>
                        
                        @foreach($categories as $category)
                        @if(!empty($category->category_items->content))
                        <span class="tag">{{$category->category_items->content}}</span>
                        @endif
                        @endforeach
                        <!--<span class="tag">洋服</span>-->
                        <!--<span class="tag">メンズ</span>-->
                    </div>
                    <div class="info-row">
                        <span class="info-label">商品の状態</span>
                        <span>{{$item->condition}}</span>
                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">コメント (1)</h2>
                    <div class="comment">
                        <div class="user-info">
                            <div class="user-icon"></div>
                            <span class="user-name">admin</span>
                        </div>
                        <div class="comment-content">
                            こちらにコメントが入ります。
                        </div>
                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">商品へのコメント</h2>
                    <textarea class="comment-input"></textarea>
                    <button class="btn-submit">コメントを送信する</button>
                </section>
            </div>
        </div>
</div>

@endsection