@extends('layouts.admin')

@section('title','分类列表')

@section('bread-title','分类列表')

@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <ul class="list-group">
                @foreach ($categories as $category)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                        父级 - {{ $category->name }}
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
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

