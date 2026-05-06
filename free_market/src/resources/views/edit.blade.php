@extends('layouts.app')
@section('title')
<title>プロフィール編集</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/edit.css')}}">
@endsection


@section('content')
<div class="container">
    <h1 class="page-title">プロフィール設定</h1>
    
    <form action="/mypage/profile" class="profile-form" method="post" enctype="multipart/form-data">
        @csrf
        <!-- プロフィール画像選択 -->
        <div class="profile-image-section">

                <img class="profile-image-placeholder" 
                src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('images/default-icon.png') }}" 
                id="profile_pic" alt="">

            <label for="photo" class="btn--select-image">画像を選択する</label>
            <input type="file" name="image" id="photo"  style="display:none;" accept="image/*">
            <!--<button type="button" class="btn--select-image">画像を選択する</button>style="display:none;"-->
        </div>

        <!-- 入力項目 -->
        <div class="form-group">
            <label for="username">ユーザー名</label>
            <input type="text" id="username" name="name" value="{{$user->name ?? null}}">
        </div>

        <div class="form-group">
            <label for="postcode">郵便番号</label>
            <input type="text" id="postcode" name="post_code" value="{{$user->post_code ?? null}}">
        </div>

        <div class="form-group">
            <label for="address">住所</label>
            <input type="text" id="address" name="address" value="{{$user->address ?? null}}">
        </div>

        <div class="form-group">
            <label for="building">建物名</label>
            <input type="text" id="building" name="building" value="{{$user->building ?? null}}">
        </div>

        <!-- 更新ボタン -->
        <button type="submit" class="btn--submit">更新する</button>
    </form>
</div>
<script>
    // input要素を取得
    const fileInput = document.getElementById('photo');
    const previewImage = document.getElementById('profile_pic');

    // ファイルが選択されたら動く処理
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0]; // 選択された1番目のファイル

        if (file) {
            // ブラウザ上で表示するための仮URLを作成
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result; // imgタグにセット
                previewImage.style.display = 'block'; // 画像を表示
            }
            
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection