@extends('layouts.admin')

@section('title','创建分类')
@section('bread-title','创建分类')


@section('content')
    @component('.admin.components.error')
    @endcomponent
    <div class="card">
        <div class="card-body">
            <form action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>父分类|当前系统只支持2层分类,文章默认读取的是子分类</label>
                    <div class="container">
                        <div class="row">
                            <select name="parent_id" class="selectpicker" data-width="100%">
                                <option value="0">不选择</option>
                                @foreach($categories as $category)
                                    @if($category->parent_id == 0)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>分类名</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">创建</button>
                </div>
            </form>
        </div>
    </div>
@endsection
