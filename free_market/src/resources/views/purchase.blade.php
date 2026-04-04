@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/purchase.css')}}">
@endsection


@section('content')
    <div class="container">
        <div class="checkout-layout">
            
            <!-- 左側：商品・支払い・配送情報 -->
            <div class="info-section">
                <div class="product-info">
                    <div class="product-image-placeholder">商品画像</div>
                    <div class="product-details">
                        <p class="product-name">{{$item->name}}</p>
                        <p class="product-price">¥ {{$item->price}}</p>
                    </div>
                </div>

                <hr>

                <div class="payment-method">
                    <h3>支払い方法</h3>
                    <select class="custom-select">
                        <option value="convenience">コンビニ払い</option>
                        <option value="card">カード支払い</option>
                    </select>
                </div>

                <hr>

                <div class="shipping-address">
                    <div class="address-header">
                        <h3>配送先</h3>
                        <a href="/purchase/address/{{$item->id}}" class="edit-link">変更する</a>
                    </div>
                    
                    <div class="address-content">
                        <p>{{$user->post_code}}</p>
                        <p>{{$user->address}}</p>
                        <p>{{$user->building}}</p>
                    </div>
                </div>

                <hr>
            </div>

            <!-- 右側：決済カード -->
            <aside class="summary-section">
                <div class="summary-card">
                    <div class="summary-row">
                        <span>商品代金</span>
                        <span>¥ {{$item->price}}</span>
                    </div>
                    <div class="summary-row">
                        <span>支払い方法</span>
                        <span>コンビニ払い</span>
                    </div>
                </div>
                <button class="btn-purchase">購入する</button>
            </aside>

        </div>
</div>

@endsection