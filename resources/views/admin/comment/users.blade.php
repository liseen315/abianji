@extends('layouts.admin')

@section('title','社交用户')

@section('bread-title','社交用户')

@section('content')
    <table class="table table-bordered table-striped table-hover table-condensed"
           @if(count($users) > 0) style="table-layout: fixed;" @endif>
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>昵称</th>
            <th style="width: 25%;">邮箱</th>
            <th>登录Ip</th>
            <th>登录次数</th>
        </tr>
        @if(count($users) > 0)
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->openid }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->nick_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->login_ip }}</td>
                    <td>{{ $user->login_times }}</td>
                </tr>
            @endforeach
        @else
            <tr style="text-align: center;">
                <td colspan="14">暂无Social用户登录</td>
            </tr>
        @endif
    </table>

    <div class="container">
        <div class="row justify-content-end">
            {{ $users->links() }}
        </div>
    </div>
@endsection

