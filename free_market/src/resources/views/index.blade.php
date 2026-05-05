@extends('layouts.app')

@section('title')
<title>ホーム</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection


@section('content')

<div class="tabs">
    <a href="{{ route('index', ['tab' => 'index','keyword' => $keyword ?? null]) }}" class="tab-item">おすすめ</a>
    <a href="{{ route('index', ['tab' => 'mylist','keyword' => $keyword ?? null]) }}" class="tab-item">マイリスト</a>
</div>
<div class="container">
        <div class="product-grid">
            @foreach($items as $item)
            <div class="product-card">
                @if(!empty($item->pic))
                <img class="product-image" src="{{ $item->pic ? asset('storage/' . $item->pic) : asset('images/default-icon.png') }}" alt="">
                @endif
                @if($item->sold==true)
                    <span class="sold-tag">sold</span>
                @endif
                <a href="/item/{{$item->id}}"><p class="product-name">{{$item->name}}</p></a>
            </div>
            @endforeach
        </div>
</div>
@endsection