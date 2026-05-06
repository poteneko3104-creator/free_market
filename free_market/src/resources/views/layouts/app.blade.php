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
            <!--ハンバーガーメニュー-->
            <div id="hamburger" class="hamburger">
                <span></span><span></span><span></span>
            </div>

            <div class="header-logo">
                 <a href="/"><img src="{{asset('images/COACHTECHヘッダーロゴ.png')}}" alt=""></a>
            </div>

            <div class="header-menu" id="header-menu">
                <form action="/search">
                    @csrf
                    <div class="search-bar">
                        <input type="text" name="keyword" placeholder="なにをお探しですか？" value="{{ $keyword ?? '' }}">
                        <button type="submit" style="display: none;">送信</button>
                    </div>
                </form>


                <nav class="header-nav" >
                    @if (Auth::check())
                    <form action="/logout" method="post">
                        @csrf
                        <button class="btn-nav">ログアウト</button>
                    </form>
                    <button type="button" class="btn-nav" onclick="location.href='/mypage'">マイページ</button>
                    <a href="/sell" class="btn-exhibit">出品</a>
                    @elseif(!Auth::check() && Request::is('/','/detail'))
                    <a href="/login" class="btn-nav">ログイン</a>
                    <a href="/sell" class="btn-exhibit">出品</a>
                    @endif
                </nav>
            </div>
        </div>        
    </header>
    <script>
        const menu = document.querySelector('#header-menu')
        const btn = document.querySelector('#hamburger')

        btn.addEventListener('click', () => {
        btn.classList.toggle('open')
        menu.classList.toggle('open')
        if(menu.classList.contains("open")){
            menu.style.height = menu.scrollHeight + 'px'
        }else{
            menu.style.height = "0"
        }
        })
    </script>   
    <main>
        @yield('content')
    </main>
</body>
</html>