@extends('layouts.frontend')
@section('title')
    归档
@endsection

@section('body')
    <section class="outer">
        <div>
            <h1 class="page-type-title">归档</h1>
            @foreach($archives as $year => $posts)
                <div class="archives-wrap">
                    <div class="archive-year-wrap">
                        <a href="javascript:void(0);" class="archive-year">{{ $year }}</a>
                    </div>
                    <div class="archives">
                        @foreach($posts as $article)
                            <article class="archive-article">
                                <div class="archive-article-inner">
                                    <header class="archive-article-header">
                                        <a href=""
                                           class="archive-article-date">{{ $article->created_at->format('m/d') }}</a>
                                        <h2>
                                            <a href="" class="archive-article-title">{{ $article->title }}</a>
                                        </h2>
                                    </header>

                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endforeach
            {{ $articles->links('app.pagination') }}
        </div>
    </section>
@endsection
