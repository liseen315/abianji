@extends('layouts.frontend')
@section('title')
    归档
@endsection

@section('body')
    <section class="outer">
        <h1 class="page-type-title">归档</h1>
        @component('.app.iteration',compact('iteration'))
        @endcomponent
        {{ $articles->links('app.pagination') }}
    </section>
@endsection
