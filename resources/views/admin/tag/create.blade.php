@extends('layouts.admin')

@section('title','创建标签')

@section('bread-title','创建标签')

@section('content')

    @component('admin.components.error')
    @endcomponent

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tag.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>标签名</label>
                    <input type="text" name="name" class="form-control" placeholder="请输入标签名">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">创建</button>
                </div>
            </form>
        </div>
    </div>
@endsection