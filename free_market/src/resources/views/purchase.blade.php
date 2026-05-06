@extends('layouts.app')

@section('title')
<title>購入</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/purchase.css')}}">
@endsection


@section('content')
    <div class="container">
        <div class="checkout-layout">
            
            <!-- 左側：商品・支払い・配送情報 -->

                <div class="info-section">
                    <form id="profile-form" action="/purchase/{{$item->id}}" method="post">
                        @csrf
                        <div class="product-info">
                            <div class="product-image-placeholder">商品画像</div>
                            <div class="product-details">
                                <input type="text" class="product-name-input" name="name" value="{{$item->name}}" readonly="readonly">
                                <input type="text" class="product-price-input" name="price" value="¥ {{$item->price}}" readonly="readonly">
                            </div>
                        </div>

                        <hr>

                        <div class="payment-method">
                            <h1>支払い方法</h1>
                            <select class="custom-select" id="purcase_method" name="purcase_method">
                                <option value="コンビニ払い">コンビニ払い</option>
                                <option value="カード支払い">カード支払い</option>
                            </select>
                            @if($errors->any('purcase_method'))
                                <span class="alert-text">{{$errors->first('purcase_method')}}</span>
                            @endif
                        </div>


                        <hr>

                        <div class="shipping-address">
                            <div class="address-header">
                                <h1>配送先</h1>
                                <a href="/purchase/address/{{$item->id}}" class="edit-link">変更する</a>
                            </div>
                            
                            <div class="address-content">
                                <input type="text" class="address-input" name="post_code" value="{{$user->post_code}}">
                                <input type="text" class="address-input" name="address" value="{{$user->address}}">
                                <input type="text" class="address-input" name="building" value="{{$user->building}}">
                                @error('post_code') <span class="alert-text">{{ $message }}</span> @enderror
                                @error('address')   <span class="alert-text">{{ $message }}</span> @enderror
                                @error('building')  <span class="alert-text">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <hr>
                     </form>
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
                        <span id = "result"></span>
                    </div>
                </div>
                <button class="btn-purchase" onclick="confirmAndSubmit()">購入する</button>
            </aside>
           
        </div>
        <script>
            const select = document.getElementById('purcase_method');
            const result = document.getElementById('result');

            select.addEventListener('change', (event) => {

                result.textContent = event.target.value;
            });
            function confirmAndSubmit() {
                        document.getElementById('profile-form').submit();
                }
        </script>
</div>

@endsection