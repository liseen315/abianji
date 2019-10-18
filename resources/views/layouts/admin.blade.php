<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Abianji - @yield('title')</title>
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.3/css/select2.min.css">--}}
    <link rel="stylesheet" href="{{ asset('assets/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}">

    <link href="{{ mix('css/admin/admin.css') }}" rel="stylesheet">
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
                <a href="{{route('dashboard')}}" class="nav-link">首页</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a class="nav-link">@yield('bread-title')</a>
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
                    {{--Dash board--}}
                    <li class="nav-item">
                        <a href="{{route('dashboard')}}" class="nav-link @sideIsActive('dashboard','active')">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>仪表盘</p>
                        </a>
                    </li>
                    {{--Article--}}
                    <li class="nav-item has-treeview @sideIsActive('article','menu-open')" >
                        <a href="javascript:void(0);" class="nav-link @sideIsActive('article','active')">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                文章管理
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('article.index')}}" class="nav-link @sideIsActive('article.index','active')">
                                    <i class="fas fa-align-justify nav-icon"></i>
                                    <p>文章列表</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('article.create') }}" class="nav-link @sideIsActive('article.create','active')">
                                    <i class="nav-icon fas fa-pen"></i>
                                    <p>创建文章</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--Category--}}
                    <li class="nav-item has-treeview @sideIsActive('category','menu-open')">
                        <a href="javascript:void(0);" class="nav-link @sideIsActive('category','active')">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                分类管理
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('category.index') }}" class="nav-link @sideIsActive('category.index','active')">
                                    <i class="fas fa-align-justify nav-icon"></i>
                                    <p>分类列表</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('category.create') }}" class="nav-link @sideIsActive('category.create','active')">
                                    <i class="nav-icon fas fa-plus-square"></i>
                                    <p>创建分类</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{--Tag--}}
                    <li class="nav-item has-treeview @sideIsActive('tag','menu-open')">
                        <a href="javascript:void(0);" class="nav-link @sideIsActive('tag','active')">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                标签管理
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('tag.index') }}" class="nav-link @sideIsActive('tag.index','active')">
                                    <i class="fas fa-align-justify nav-icon"></i>
                                    <p>标签列表</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('tag.create') }}" class="nav-link @sideIsActive('tag.create','active')">
                                    <i class="nav-icon fas fa-plus-square"></i>
                                    <p>创建标签</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>

    {{--Content Wrapper--}}
    <div class="content-wrapper">
        <section class="content pt-4 pb-4">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
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
<script src="{{ asset('assets/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{--<script src="{{ asset('assets/select2/js/select2.min.js') }}"></script>--}}
{{--用上面正式版的js竟然还会有bug...--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.3/js/select2.min.js"></script>
<script src="{{ asset('assets/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
<script src="{{ mix('js/admin/admin.js') }}"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    })
</script>
@yield('scripts')
</body>
</html>