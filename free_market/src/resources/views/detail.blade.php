@extends('layouts.app')

@section('title')
<title>商品詳細</title>
@endsection

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
            <!--'coments','comentsCount','likesCount','like'-->

           
            <!-- 右側：商品情報 -->
            <div class="product-details">
                <h1 class="product-title">{{$item->name}}</h1>
                <p class="brand-name">{{$item->brand}}</p>
                <div class="price">¥{{$item->price}} <span>(税込)</span></div>
                
                <div class="stats">

                        <div class="stat-item">
                            @if(!empty($like->status) && $like->status==true)                
                                <a href="/likes_unchecked/{{$item->id}}"><img src="{{asset('images/ハートロゴ_ピンク.png')}}" alt=""></a>                        
                            @else
                                <a href="/likes_checked/{{$item->id}}"><img src="{{asset('images/ハートロゴ_デフォルト.png')}}" alt=""></a>
                            @endif
                            <span>{{$likesCount}}</span></div>
                        <div class="stat-item"><img src="{{asset('images/ふきだしロゴ.png')}}" alt=""> <span>{{$comentsCount}}</span></div>
                </div>

                <a href="/purchase/{{$item->id}}" class="btn-purchase">購入手続きへ</a>

                <section class="section">
                    <h2 class="section-title">商品説明</h2>
                    <p>{{$item->detail}}</p>
                </section>

                <section class="section">
                    <h2 class="section-title">商品の情報</h2>
                    <div class="info-row">
                        <span class="info-label">カテゴリー</span>                        
                        @foreach($categories as $category)
                        @if(!empty($category->categoryMaster->content))
                        <span class="tag">{{$category->categoryMaster->content}}</span>
                        @endif
                        @endforeach
                    </div>
                    <div class="info-row">
                        <span class="info-label">商品の状態</span>
                        <span>{{$item->condition}}</span>
                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">コメント ({{$comentsCount}})</h2>
                    <div class="comment">
                        @foreach($coments as $coment)
                        <div class="user-info">
                            <div class="user-icon">
                                <img src="{{$coment->user?->pic}}" alt="">
                            </div>
                            <span class="user-name">{{$coment->user?->name}}</span>
                        </div>
                        <div class="comment-content">
                            {{$coment->content}}
                        </div>
                        @endforeach

                    </div>
                </section>

                <section class="section">
                    <h2 class="section-title">商品へのコメント</h2>
                    <form action="/coment_register" method="post">
                        @csrf
                    <input type="hidden" name="itemId" value="{{$item->id}}">
                    <textarea class="comment-input" name="content" value="{{old('content')}}"></textarea>
                    @if($errors->any('content'))
                        <span class="alert-text">{{$errors->first('content')}}</span>
                     @endif
                    <button class="btn-submit">コメントを送信する</button>
                    </form>
                </section>
            </div>
        </div>
</div>

@endsection