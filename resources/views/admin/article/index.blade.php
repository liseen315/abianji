@extends('layouts.admin')

@section('title','文章列表')

@section('bread-title','文章列表')

@section('content')
    @component('.admin.components.success')
    @endcomponent

    <table class="table table-bordered table-striped table-hover table-condensed">
        <tr>
            <th style="width: 10%">ID</th>
            <th>标题</th>
            <th>点击数</th>
            <th>创建时间</th>
            <th style="width: 15%">操作</th>
        </tr>
        @foreach($articles as $article)
            <tr>
                <td>{{ $article->id }}</td>
                <td>{{ $article->title }}</td>
                <td>{{ $article->views }}</td>
                <td>{{ $article->created_at }}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-primary mr-1">编辑</button>
                    <button type="button" class="btn btn-primary btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>

@endsection