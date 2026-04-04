@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/address.css')}}">
@endsection


@section('content')
    <main class="container-small">
        <h2 class="page-title">住所の変更</h2>

        <form class="address-form" action="/purchase/address/{{$item->id}}" method="post">
            @csrf
            <div class="form-group">
                <label for="postal-code">郵便番号</label>
                <input type="text" id="postal-code" name="post_code">
            </div>

            <div class="form-group">
                <label for="address">住所</label>
                <input type="text" id="address" name="address">
            </div>

            <div class="form-group">
                <label for="building">建物名</label>
                <input type="text" id="building" name="building">
            </div>

            <button type="submit" class="btn-update">更新する</button>
        </form>
    </main>

@endsection