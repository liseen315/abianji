@extends('layouts.admin')

@section('title','创建文章')

@section('contentHeader','创建文章')

@section('style')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/editormd/css/editormd.min.css') }}">
@endsection

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>选择分类</label>
                            <div class="input-group">
                                <select name="category_id" class="form-control select2">
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
                        <div class="form-group">
                            <label>标题</label>
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label>标签</label>
                            <div class="container">
                                <div class="row">
                                    <select class="select2 col-md-10" multiple="multiple" data-placeholder="选择标签">
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>California</option>
                                        <option>Delaware</option>
                                        <option>Tennessee</option>
                                        <option>Texas</option>
                                        <option>Washington</option>
                                    </select>
                                    <button type="button" class="btn btn-block btn-primary col-md-1 ml-md-5">添加标签</button>
                                </div>
                            </div>
                            <div class="input-group">

                            </div>
                        </div>

                        <div class="form-group">
                            <label>内容</label>
                            <div id="abianji-content">
                                <textarea name="markdown">{{ old('markdown') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/editormd/editormd.min.js') }}"></script>
    <script>

        $(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            })

            editormd.urls.atLinkBase = "https://github.com/";

            let testEditor = editormd("abianji-content", {
                autoFocus : false,
                width     : "100%",
                height    : 720,
                toc       : true,
                //atLink    : false,    // disable @link
                //emailLink : false,    // disable email address auto link
                todoList  : true,
                placeholder: "{{ 'Enter article content' }}",
                toolbarAutoFixed: false,
                path      : '{{ asset('/plugins/editormd/lib') }}/',
                emoji: true,
                toolbarIcons : ['undo', 'redo', 'bold', 'del', 'italic', 'quote', 'uppercase', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'list-ul', 'list-ol', 'hr', 'link', 'reference-link', 'image', 'code', 'code-block', 'table', 'emoji', 'html-entities', 'watch', 'preview', 'search'],
                imageUpload: true,
                imageUploadURL : '',
            });
        })
    </script>
@endsection