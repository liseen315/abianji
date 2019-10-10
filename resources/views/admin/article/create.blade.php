@extends('layouts.admin')

@section('title','创建文章')

@section('contentHeader','创建文章')

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>选择分类</label>
                            <select name="category_id" class="form-control" style="width: 100%;"></select>
                        </div>
                        <div class="form-group">
                            <label>标题</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                            <label>标签</label>
                            <select class="select2" multiple="multiple" data-placeholder="选择标签" style="width: 100%;">
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')
    <script src="{{ url('js/plugins/select2/js/select2.js') }}"></script>
@endsection