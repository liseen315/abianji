@extends('layouts.admin')

@section('title','创建配置')

@section('bread-title','创建配置')

@section('content')

    @component('admin.components.error')
    @endcomponent

    <div class="card">
        <div class="card-body">
            <form action="{{ route('config.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>配置title 对应编辑表单的字段</label>
                    <input type="text" name="title" class="form-control" placeholder="请输入title">
                </div>
                <div class="form-group">
                    <label>配置name</label>
                    <input type="text" name="name" class="form-control" placeholder="请输入Name">
                </div>
                <div class="form-group">
                    <label>配置类型|默认text</label>
                    <select name="category_id" class="form-control select2">
                        <option value="text" selected>text</option>
                        <option value="textarea">textarea</option>
                        <option value="radio">radio</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">创建</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.select2').select2({
            theme: 'bootstrap4'
        })
    </script>
@endsection
