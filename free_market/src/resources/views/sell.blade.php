@extends('layouts.app')

@section('title')
<title>商品出品</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/sell.css')}}">
@endsection


@section('content')

<div class="container">
    <h1 class="page-title">商品の出品</h1>

    <form action="/sell" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- 商品画像セクション -->
        <section class="form-section">
            <h2 class="section-label">商品画像</h2>
            
            <div class="image-upload-wrapper">
                <div class="upload-box" id="upload-container">
                    <!-- 初期表示：ラベル（ボタン） -->
                        <label class="btn-outline-red" id="label-button">
                            <span id="label-text">画像を選択する</span> <!-- spanを追加 -->
                            <input type="file" name="image" id="image-input" style="display:none;" accept="image/*">
                        </label>
                    <!-- プレビュー画像（最初は非表示） -->
                    <img id="image-preview" src="" alt="プレビュー" style="display:none; max-width: 100%; max-height: 100%; object-fit: contain;">
                </div>
            </div>

            <!--
            <div class="upload-box">
                <label class="btn-outline-red">
                    画像を選択する
                    <div id="preview" style="margin-top: 10px;"></div>
                    <input type="file" name="image" style="display:none;" accept="image/*">
                </label>
            </div>
            -->
        </section>
               @if($errors->any('image'))
                    <span class="alert-text">{{$errors->first('image')}}</span>
                @endif
        <!-- 商品の詳細セクション -->
        <section class="form-section">
            <h2 class="section-title">商品の詳細</h2>
            
            <div class="form-group">
                <label class="item-label">カテゴリー</label>
                <div class="tag-container">
                    @foreach($categories as $category)
                        <!--<input type="checkbox" class="cat-check" id="cat-{{$category->id}}" name="categories[]" value="{{$category->id}}">-->
                    <input 
                    type="checkbox" 
                    class="cat-check" 
                    id="cat-{{$category->id}}" 
                    name="categories[]" 
                    value="{{$category->id}}"
                    {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'checked' : '' }}
                    >
                        <label for="cat-{{$category->id}}" class="tag">{{$category->content}}</label>
                    @endforeach
                </div>
                @if($errors->any('categories'))
                    <span class="alert-text">{{$errors->first('categories')}}</span>
                @endif
            </div>

            <div class="form-group">
                <label class="item-label">商品の状態</label>
                <div class="select-wrapper">
                    <select class="form-input" name="condition">
                        <option value="" disabled {{ old('condition') === null ? 'selected' : '' }}>選択してください</option>
                        <option value="良好" @selected(old('condition') == "良好")>良好</option>
                        <option value="目立った傷や汚れなし" @selected(old('condition') == "目立った傷や汚れなし")>目立った傷や汚れなし</option>
                        <option value="やや傷や汚れあり" @selected(old('condition') == "やや傷や汚れあり")>やや傷や汚れあり</option>
                        <option value="状態が悪い" @selected(old('condition') == "状態が悪い")>状態が悪い</option>
                    </select>
                </div>
            </div>
            @if($errors->any('condition'))
                <span class="alert-text">{{$errors->first('condition')}}</span>
            @endif
        </section>

        <!-- 商品名と説明セクション -->
        <section class="form-section">
            <h2 class="section-title">商品名と説明</h2>
            
            <div class="form-group">
                <label class="item-label">商品名</label>
                <input type="text" class="form-input" name="name" value="{{old('name')}}">
            </div>
            @if($errors->any('name'))
                <span class="alert-text">{{$errors->first('name')}}</span>
            @endif            

            <div class="form-group">
                <label class="item-label">ブランド名</label>
                <input type="text" class="form-input" name="brand" value="{{old('brand')}}">
            </div>
            @if($errors->any('brand'))
                <span class="alert-text">{{$errors->first('brand')}}</span>
            @endif 

            <div class="form-group">
                <label class="item-label">商品の説明</label>
                <textarea class="form-input" rows="5" name="detail" value="{{old('detail')}}"></textarea>
            </div>
            @if($errors->any('detail'))
                <span class="alert-text">{{$errors->first('detail')}}</span>
            @endif       

            <div class="form-group">
                <label class="item-label">販売価格</label>
                <div class="price-input">
                    <span class="currency">¥</span>
                    <input type="number" name="price" class="form-input" value="{{old('price')}}">
                </div>
            </div>
            @if($errors->any('price'))
                <span class="alert-text">{{$errors->first('price')}}</span>
            @endif 

        </section>

        <!-- 出品ボタン -->
        <button type="submit" class="btn-submit">出品する</button>
    </form>
</div>
<script>
    document.getElementById('image-input').addEventListener('change', function(e) {
        const file = e.target.files[0]; // files[0]を指定
        const container = document.getElementById('upload-container');
        const label = document.getElementById('label-button');
        const labelText = document.getElementById('label-text'); // spanを取得
        const preview = document.getElementById('image-preview');
        const wrapper = container.parentElement;

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // 画像を表示
                preview.src = e.target.result;
                preview.style.display = 'block';

                // ラベルを移動
                wrapper.appendChild(label);
                
                // 重要：中のinputを消さないように、テキストだけを変える
                labelText.textContent = '画像を替えたい場合はこちら';
                label.style.marginTop = '15px';
                
                // upload-boxの余白を消すと画像が大きく見えます
                container.style.padding = '0';
            }

            reader.readAsDataURL(file);
        }
    });

</script>
@endsection