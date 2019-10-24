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
            @component('admin.article.form',compact('categories','tags'))
                @slot('store')
                    {{ route('article.store') }}
                @endslot
            @endcomponent
        </div>
    </div>

    <div id="loadingModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <h5>正在上传图片...</h5>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/editormd/editormd.min.js') }}"></script>
    <script>
        var editormdPath = '{{ asset('/assets/editormd/lib') }}/'
        var imgUpLoadPath = '{{ route('article.upload') }}'
    </script>
    <script src="{{ mix('js/admin/article.js') }}"></script>
@endsection
