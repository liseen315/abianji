@extends('layouts.frontend')
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.css') }}">
@endsection
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
                                <li class="article-tag-list-item">
                                    <a href="" class="article-tag-list-link">{{ $tagItem->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="article-nav">
                @if(!is_null($prev))
                    <a href="{{ $prev->url }}" class="article-nav-link">
                        <strong class="article-nav-caption">前一篇</strong>
                        <div class="article-nav-title">{{ $prev->title }}</div>
                    </a>
                @endif
                @if(!is_null($next))
                    <a href="{{ $next->url }}" class="article-nav-link">
                        <strong class="article-nav-caption">后一篇</strong>
                        <div class="article-nav-title">{{ $next->title }}</div>
                    </a>
                @endif
            </div>
        </article>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/tocbot/tocbot.js') }}"></script>
    <script type="text/javascript" src="{{mix('js/home/article.js')}}"></script>
@endsection
