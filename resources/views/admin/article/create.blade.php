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
    @component('.admin.components.loading')
    @endcomponent
@endsection

@section('scripts')
    <script src="{{ asset('assets/editormd/editormd.min.js') }}"></script>
    <script>
        var editormdPath = '{{ asset('/assets/editormd/lib') }}/'
        var imgUpLoadPath = '{{ route('article.upload') }}'
    </script>
    <script src="{{ mix('js/admin/article.js') }}"></script>
@endsection
