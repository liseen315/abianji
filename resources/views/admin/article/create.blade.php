@extends('layouts.admin')

@section('title','创建文章')

@section('bread-title','创建文章')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editormd/css/editormd.min.css') }}">
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
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
                            <select class="select2 col-md-10" multiple="multiple" >
                                <option>Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                            <button type="button" class="btn btn-primary ml-md-5" data-toggle="modal" data-target="#tagModal">添加标签</button>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>文章封面</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="J_coverImgInput" name="cover" accept="image/png, image/jpeg, image/gif, image/jpg">
                        <label class="custom-file-label" for="J_coverImgInput">Choose file</label>
                    </div>
                </div>

                <div class="form-group">
                    <label>内容</label>
                    <div id="abianji-content">
                        <textarea name="markdown">{{ old('markdown') }}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label>是否置顶</label>
                    <div class="container">
                        <div class="row">
                            <div class="form-check col-auto">
                                <input class="form-check-input" type="radio" name="is_top" value="1" id="top">
                                <label class="form-check-label" for="top">置顶</label>
                            </div>
                            <div class="form-check col-auto">
                                <input class="form-check-input" type="radio" name="is_top" value="0" id="unTop" checked>
                                <label class="form-check-label" for="unTop">取消置顶</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="container">
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    {{--Tag Modal--}}
    <div class="modal fade" id="tagModal" tabindex="-1" role="dialog" aria-labelledby="tagModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">添加标签</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form class="form-group" role="form">
                        <input class="form-control mb-3" type="text" placeholder="标签名">
                        <button type="button" class="btn btn-block btn-primary" id="J_submitTagBtn">提交</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/editormd/editormd.min.js') }}"></script>
    <script>

        $(function() {
            $('.select2').select2({
                theme: 'bootstrap4'
            })
            editormd.urls.atLinkBase = "https://github.com/";

            editormd("abianji-content", {
                autoFocus : false,
                width     : "100%",
                height    : 720,
                toc       : true,
                //atLink    : false,    // disable @link
                //emailLink : false,    // disable email address auto link
                todoList  : true,
                placeholder: "{{ 'Enter article content' }}",
                toolbarAutoFixed: false,
                path      : '{{ asset('/assets/editormd/lib') }}/',
                emoji: true,
                toolbarIcons : ['undo', 'redo', 'bold', 'del', 'italic', 'quote', 'uppercase', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'list-ul', 'list-ol', 'hr', 'link', 'reference-link', 'image', 'code', 'code-block', 'table', 'emoji', 'html-entities', 'watch', 'preview', 'search'],
                imageUpload: true,
                imageUploadURL : '',
            });

            $('#J_submitTagBtn').on('click',function (event) {
                console.log('click add Tag');
            })
            
            $('#J_coverImgInput').on('change',function () {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            })
        })
    </script>
@endsection