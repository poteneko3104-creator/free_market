@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
@endsection


@section('content')

<div class="tabs">
    <a href="#" class="tab-item">おすすめ</a>
    <a href="{{ route('index', ['tab' => 'mylist']) }}" class="tab-item">マイリスト</a>
</div>
<div class="container">

            @foreach($items as $item)
            <div class="product-card">
                <img class="product-image" src="{{$items->pic}}" alt="">
                <p class="product-name">{{$items->name}}</p>
            </div>
            @endforeach
        </div>
</div>
@endsection