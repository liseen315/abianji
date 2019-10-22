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
                    <div class="preview-box J_previewBox">
                        <div class="preview-text J_previewText">文件预览窗口</div>
                    </div>
                    <div class="input-group cover-group">
                        <input type="text" class="form-control cover-input J_coverLabel" disabled>
                        <div class="btn btn-primary btn-file J_browseBox">
                            <i class="fas fa-folder"></i>
                            <span>浏览文件</span>
                            <input type="file" class="file" id="J_ImgFile" accept="image/*">
                        </div>
                        <div class="btn-group J_optionBox">
                            <div class="btn btn-secondary J_delBtn">
                                <i class="fas fa-trash-alt"></i>
                                <span>删除</span>
                            </div>
                            <div class="btn btn-secondary J_uploadBtn">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <span>上传</span>
                            </div>
                        </div>
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
            let uploadFile = null

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


            $('#J_ImgFile').on('change', function (event) {
                $('.J_previewText').hide();
                uploadFile = event.target.files[0];
                showPreview(uploadFile);
                $('.J_coverLabel').val(uploadFile.name);
                $('.J_previewContent').remove()
                $('.J_browseBox').hide();
                $('.J_optionBox').addClass('d-flex').show();
            })

            $('.J_delBtn').on('click', function () {
                uploadFile = null
                $('.J_previewText').show();
                $('.J_previewContent').remove()
                $('.J_coverLabel').val('');
                $('.J_optionBox').removeClass('d-flex').hide();
                $('.J_browseBox').show();
            })
            
            $('.J_uploadBtn').on('click',function () {
                
            })
        })

        function showPreview(file) {
            $('.J_coverLabel').val(file.name);
            let reader = new FileReader();
            reader.onload = function (e) {
                let html = `<div class="preview-content J_previewContent"><img src="${e.target.result}" alt=""></div>`
                $('.J_previewBox').append(html);
            }
            reader.readAsDataURL(file);
        }
    </script>
@endsection
