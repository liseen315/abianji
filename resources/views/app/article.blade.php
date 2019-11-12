@extends('layouts.frontend')
@section('body')
    <section class="outer">
        <article class="article" itemscope itemprop="blog" data-scroll-reveal>
            <div class="article-inner">
                <header class="article-header">
                    <h1 class="article-title">{{ $article->title }}</h1>
                </header>
                <div class="article-meta">
                    <div class="article-date">{{ $article->created_at->format('Y-m-d') }}</div>
                    <div class="article-category">{{ $article->category->name }}</div>
                </div>
                <div class="tocbot"></div>
                <div class="article-entry">
                    {!! $article->content !!}
                </div>
                <div class="article-footer">
                    @if(count($article->tags))
                        <ul class="article-tag-list">
                            @foreach($article->tags as $tagItem)
                                <li class="article-tag-list-item">{{ $tagItem->name }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="article-nav">

            </div>
        </article>
    </section>
@endsection
