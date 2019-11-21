@extends('layouts.frontend')
@section('title')
    分类
@endsection
@section('body')
    <section class="outer">
        <h1 class="page-type-title">*{{ $category->name }}</h1>
        @component('.app.iteration',compact('iteration'))
        @endcomponent
        {{ $articles->links('app.pagination') }}
    </section>
@endsection
