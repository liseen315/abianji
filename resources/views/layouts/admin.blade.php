<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Abianji - @yield('title')</title>
    @yield('style')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    {{--Navbar--}}
    <div class="main-header navbar navbar-expand navbar-white navbar-light">
        {{-- Left navbar--}}
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="javascript:void(0);" data-widget="pushmenu" class="nav-link"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{route('dashboard')}}" class="nav-link">Home</a>
            </li>
        </ul>
        {{--Right navbar--}}
        <ul class="navbar-nav ml-auto">

        </ul>
    </div>
    {{--/.navbar--}}

    {{--Main SideBar Container--}}
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        {{--logo--}}
        <a href="{{route('dashboard')}}" class="brand-link">
            <img src="{{url('images/AdminLTELogo.png')}}" alt="Abianji Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Abianji-AdminPanel</span>
        </a>
    </aside>

</div>
</body>
</html>