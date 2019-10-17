@extends('layouts.admin')

@section('title','编辑分类')

@section('bread-title','编辑分类')

@section('content')
    @component('.admin.components.error')
    @endcomponent

    <div class="card">
        <div class="card-body">
            <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>新分类名</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">更新分类</button>
                </div>
            </form>
        </div>
    </div>
@endsection

