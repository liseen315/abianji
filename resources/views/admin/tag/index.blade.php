@extends('layouts.admin')

@section('title','标签列表')

@section('bread-title','标签列表')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table table-bordered table-striped table-hover table-condensed">
        <tr>
            <th style="width: 10%;">ID</th>
            <th>标签名</th>
            <th style="width: 15%; text-align: center;">操作</th>
        </tr>
        @foreach($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->name }}</td>
                <td style="text-align: center;">
                    <button type="button" class="btn btn-sm btn-primary mr-1">编辑</button>
                    <button type="button" class="btn btn-sm btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
@endsection