@extends('layouts.admin')

@section('title','分类列表')

@section('bread-title','分类列表')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if(count($categories) > 0 )
            <ul class="list-group">
                @foreach ($categories as $category)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        {{ $category->name }}
                        <div class="d-flex">
                            <button type="button" class="btn btn-sm btn-primary mr-1 ">编辑</button>
                            <button type="button" class="btn btn-sm btn-danger">删除</button>
                        </div>
                    </div>
                    @if ($category->children->count() > 0)
                    <ul class="list-group mt-2">
                        @foreach ($category->children as $child)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                {{ $child->name }}
                                <div class="d-flex">
                                    <button type="button" class="btn btn-sm btn-primary mr-1">编辑</button>
                                    <button type="button" class="btn btn-sm btn-danger">删除</button>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
            @else
                暂无分类
                <a href="{{route('category.create')}}">去创建</a>
            @endif
        </div>
    </div>
@endsection

