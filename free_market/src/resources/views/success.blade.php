@extends('layouts.app')

@section('title')
<title>購入完了</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/success.css')}}">
@endsection


@section('content')
<h1 class="success-txt">購入手続きが完了しました</h1>
<a href="/" class="return-btn">商品一覧へ戻る</a>
@endsection