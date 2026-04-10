@extends('layouts.app')

@section('title')
<title>商品出品</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/sell.css')}}">
@endsection


@section('content')

<div class="container">
    <h2 class="page-title">商品の出品</h2>

    <form action="/sell" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- 商品画像セクション -->
        <section class="form-section">
            <h3 class="section-label">商品画像</h3>
            <div class="upload-box">
                <label class="btn-outline-red">
                    画像を選択する
                    <input type="file" name="image" style="display:none;" accept="image/*">
                </label>
            </div>
        </section>

        <!-- 商品の詳細セクション -->
        <section class="form-section">
            <h3 class="section-title">商品の詳細</h3>
            
            <div class="form-group">
                <label class="item-label">カテゴリー</label>
                <div class="tag-container">
                    @foreach($categories as $category)
                        <input type="checkbox" id="cat-{{$category->id}}" name="category" value="{{$category->content}}" style="display: none;">
                        <label for="cat-{{$category->id}}" class="tag">{{$category->content}}</label>
                    @endforeach
                    <!--
                    <span class="tag">ファッション</span>
                    <span class="tag">家電</span>
                    <span class="tag selected">インテリア</span>
                    <span class="tag">レディース</span>
                    <span class="tag">メンズ</span>
                    <span class="tag">コスメ</span>
                    <span class="tag">本</span>
                    <span class="tag">ゲーム</span>
                    <span class="tag">スポーツ</span>
                    <span class="tag">キッチン</span>
                    <span class="tag">ハンドメイド</span>
                    <span class="tag">アクセサリー</span>
                    <span class="tag">おもちゃ</span>
                    <span class="tag">ベビー・キッズ</span>
                    -->
                </div>
            </div>

            <div class="form-group">
                <label class="item-label">商品の状態</label>
                <div class="select-wrapper">
                    <select class="form-input" name="condition">
                        <option value="" disabled selected>選択してください</option>
                        <option value="良好">良好</option>
                        <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                        <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                        <option value="状態が悪い">状態が悪い</option>
                    </select>
                </div>
            </div>
        </section>

        <!-- 商品名と説明セクション -->
        <section class="form-section">
            <h3 class="section-title">商品名と説明</h3>
            
            <div class="form-group">
                <label class="item-label">商品名</label>
                <input type="text" class="form-input" name="name">
            </div>

            <div class="form-group">
                <label class="item-label">ブランド名</label>
                <input type="text" class="form-input" name="brand">
            </div>

            <div class="form-group">
                <label class="item-label">商品の説明</label>
                <textarea class="form-input" rows="5" name="detail"></textarea>
            </div>

            <div class="form-group">
                <label class="item-label">販売価格</label>
                <div class="price-input">
                    <span class="currency">¥</span>
                    <input type="number" name="price" class="form-input">
                </div>
            </div>
        </section>

        <!-- 出品ボタン -->
        <button type="submit" class="btn-submit">出品する</button>
    </form>
</div>
@endsection