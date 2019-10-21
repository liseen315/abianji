@extends('layouts.admin')

@section('title','创建文章')

@section('bread-title','创建文章')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editormd/css/editormd.min.css') }}">
@endsection

@section('content')
    @component('.admin.components.error')
    @endcomponent

    <div class="card">
        <div class="card-body">
            <form action="{{ route('article.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>选择分类</label>
                    <div class="input-group">
                        <select name="category_id" class="form-control select2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label>标题</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                </div>

                <div class="form-group">
                    <label>标签</label>
                    <select class="form-group select2" style="width: 100%;" multiple="multiple" name="tag_list[]">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>文章封面</label>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <div class="btn btn-primary">浏览</div>
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


@endsection

@section('scripts')
    <script src="{{ asset('assets/editormd/editormd.min.js') }}"></script>
    <script>

        $(function () {
            $('.select2').select2({
                theme: 'bootstrap4',
                tags: true,
                tokenSeparators: [",", " "],
                createTag: function (newTag) {
                    return {
                        id: 'new:' + newTag.term,
                        text: newTag.term + ' (new)'
                    };
                }
            })

            editormd.urls.atLinkBase = "https://github.com/";

            editormd("abianji-content", {
                autoFocus: false,
                width: "100%",
                height: 720,
                toc: true,
                todoList: true,
                placeholder: "{{ 'Enter article content' }}",
                toolbarAutoFixed: false,
                path: '{{ asset('/assets/editormd/lib') }}/',
                emoji: true,
                toolbarIcons: ['undo', 'redo', 'bold', 'del', 'italic', 'quote', 'uppercase', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'list-ul', 'list-ol', 'hr', 'link', 'reference-link', 'image', 'code', 'code-block', 'table', 'emoji', 'html-entities', 'watch', 'preview', 'search'],
                imageUpload: true,
                imageUploadURL: '',
            });

            // $('#J_coverImgInput').on('change', function () {
            //     let fileName = $(this).val().split('\\').pop();
            //     $(this).next('.custom-file-label').addClass("selected").html(fileName);
            // })
        })
    </script>
@endsection
