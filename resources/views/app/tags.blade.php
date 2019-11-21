@extends('layouts.frontend')
@section('title')
    标签
@endsection
@section('body')
    <section class="outer">
        <h1 class="page-type-title">#{{ $tag->name }}</h1>
        @component('.app.iteration',compact('iteration'))
        @endcomponent
    </section>
@endsection
