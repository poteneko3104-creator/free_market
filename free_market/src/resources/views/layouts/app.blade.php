<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('title')
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    @yield('css')
</head>
<body>
    <header>
        <div class="header-box">
            <div class="header-logo">
                <!-- ロゴ画像がある場合はここをimgタグに -->
                 <a href="/"><img src="{{asset('images/COACHTECHヘッダーロゴ.png')}}" alt=""></a>
            </div>


            <form action="/search">
                @csrf
                <div class="search-bar">
                    <input type="text" name="keyword" placeholder="なにをお探しですか？">
                    <button type="submit" style="display: none;">送信</button>
                </div>
            </form>


            <nav class="header-nav">
                @if (Auth::check())
                <form action="/logout" method="post">
                    @csrf
                    <button class="btn-nav">ログアウト</button>
                </form>
                <button type="button" class="btn-nav" onclick="location.href='/mypage'">マイページ</button>
                <a href="sell" class="btn-exhibit">出品</a>
                @elseif(!Auth::check() && Request::is('/','/detail'))
                <a href="/login" class="btn-nav">ログイン</a>
                <a href="sell" class="btn-exhibit">出品</a>
                @endif
            </nav>
        </div>                
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>