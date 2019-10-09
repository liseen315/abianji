<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Abianji - @yield('title')</title>
    <link href="{{ mix('css/admin/admin.css') }}" rel="stylesheet">
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
                <a href="{{route('dashboard')}}" class="nav-link">首页</a>
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
            <span class="brand-text font-weight-light">管理面板</span>
        </a>
        <div class="sidebar">
            {{--Sidebar Menu--}}
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link {{ (strpos(Route::currentRouteName(),'dashboard') == 0)? 'active': '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>仪表盘</p>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    {{--Content Wrapper--}}
    <div class="content-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
    {{--footer--}}
    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2019 <a href="https://abianji.com"></a>Abianji</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 0.0.1
        </div>
    </footer>
</div>
@yield('scripts')
</body>
</html>