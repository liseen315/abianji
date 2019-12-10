@extends('layouts.admin')

@section('title', 'DashBoard')

@section('bread-title','仪表盘')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $articles }}</h3>

                    <p>Articles</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="{{ route('article.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $socialUsers }}</h3>

                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('comment.users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $comments }}</h3>

                    <p>Comments</p>
                </div>
                <div class="icon">
                    <i class="fas fa-comments"></i>
                </div>
                <a href="{{ route('comment.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $category }}</h3>

                    <p>Category</p>
                </div>
                <div class="icon">
                    <i class="fas fa-th"></i>
                </div>
                <a href="{{ route('category.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
{{--    <div class="col-md-4">--}}
{{--        <div class="x_panel">--}}
{{--            <div class="x_title">--}}
{{--                <p>系统环境:</p>--}}
{{--            </div>--}}
{{--            <div class="x_content bjy-content">--}}
{{--                <ul class="list-inline widget_tally">--}}
{{--                    <li>--}}
{{--                        <p>--}}
{{--                            <span class="month">系统: </span>--}}
{{--                            <span class="count">{{ $version['system'] }}</span>--}}
{{--                        </p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>--}}
{{--                            <span class="month">Web服务器: </span>--}}
{{--                            <span class="count">{{ $version['webServer'] }}</span>--}}
{{--                        </p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>--}}
{{--                            <span class="month">PHP: </span>--}}
{{--                            <span class="count">{{ $version['php'] }}</span>--}}
{{--                        </p>--}}
{{--                    </li>--}}
{{--                    <li>--}}
{{--                        <p>--}}
{{--                            <span class="month">MySQL: </span>--}}
{{--                            <span class="count">{{ $version['mysql'] }}</span>--}}
{{--                        </p>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
