@extends('layouts.admin')
@section('title','关于我')
@section('bread-title','关于我')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/editormd/css/editormd.min.css') }}">
@endsection

@section('content')
    @component('.admin.components.error')
    @endcomponent
    <div class="card">
        <div class="card-body">
            <form action="@if(is_null($about)){{ route('about.store') }}@else{{ route('about.update') }} @endif"
                  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <div id="J_aboutContent">
                        @if(is_null($about))
                            <textarea name="markdown">{{ old('markdown') }}</textarea>
                        @else
                            <textarea name="markdown">{{ $about->markdown }}</textarea>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="container">
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                @if(is_null($about))
                                    创建
                                @else
                                    编辑
                                @endif
                            </button>
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
        var editormdPath = '{{ asset('/assets/editormd/lib') }}/'

        editormd.urls.atLinkBase = "https://abianji.com";

        editormd("J_aboutContent", {
            autoFocus: false,
            width: "100%",
            height: 360,
            toc: true,
            todoList: true,
            placeholder: "{{ 'Enter about content' }}",
            toolbarAutoFixed: false,
            path: editormdPath,
            emoji: true,
            toolbarIcons: ['undo', 'redo', 'bold', 'del', 'italic', 'quote', 'uppercase', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'list-ul', 'list-ol', 'hr', 'link', 'reference-link', 'code', 'code-block', 'table', 'html-entities', 'watch', 'preview', 'search'],
            imageUpload: false,
            imageUploadURL: '',
        });
    </script>
@endsection
