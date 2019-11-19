<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="{{ blog_config('keywords') }}">
    <meta name="description" content="{{ blog_config('description') }}">
    <title>@yield('title') @if(request()->path() !== '/') - {{ blog_config('site_name') }} @endif</title>
    @yield('style')
    <link rel="stylesheet" href="{{ mix('css/home/home.css') }}">
</head>
<body>
<main class="content">
    @yield('body')
    <footer class="footer">
        <div class="outer">
            <div class="float-right"></div>
            <ul class="list-inline">
                <li>{{ blog_config('ipc') }}</li>
                <li>Powered by <a href="https://github.com/liseen315/abianji" target="_blank">Abianji</a></li>
                <li>Theme <a href="https://github.com/zhwangart/hexo-theme-ocean" target="_blank">Ocean</a></li>
            </ul>
        </div>
    </footer>
</main>
<aside class="sidebar">
    <button class="navbar-toggle"></button>
    <nav class="navbar">
        <div class="logo">
            <a href="{{ route('home.index') }}"><img src="{{ $user->avatar }}" alt="{{ blog_config('site_name') }}"></a>
        </div>
        <ul class="nav nav-main">
            <li class="nav-item">
                <a href="{{ route('home.index') }}" class="nav-item-link"><i class="fe icon-home"></i>首页</a>
            </li>
            <li class="nav-item">
                <a href="{{ route('home.archives') }}" class="nav-item-link"><i class="fe icon-folder"></i>归档</a>
            </li>
        </ul>
    </nav>
</aside>
@yield('scripts')
<script type="text/javascript" src="{{ mix('js/home/home.js') }}"></script>
</body>
</html>
