@extends('layouts.frontend')
@section('title')
    {{ blog_config('site_name') }}
@endsection
@section('body')
    <section class="jumbotron">
        <div class="video">
            <div class="video-frame">
                <img src="https://res.cloudinary.com/dnakxpzhj/image/upload/v1578622409/blog/ocean/overlay-hero.png" alt="Decorative image frame">
            </div>
            <div class="video-media">
                <video playsinline="" autoplay="" loop="" muted="" data-autoplay=""
                       poster="https://res.cloudinary.com/dnakxpzhj/image/upload/v1578622419/blog/ocean/ocean.png">
                    <source src="https://res.cloudinary.com/dnakxpzhj/video/upload/v1578622424/blog/ocean/ocean.mp4" type="video/mp4">
                    <p>Your user agent does not support the HTML5 Video element.</p>
                </video>
                <div class="video-overlay"></div>
            </div>
            <div class="video-inner text-center text-white">
                <h1><a href="{{ route('home.index') }}">{{ blog_config('site_name') }}</a></h1>
                <p>{{ blog_config('sub_title') }}</p>
            </div>
            <div class="video-learn-more">
                <a href="#landingpage" class="anchor"><i class="fe icon-mouse"></i></a>
            </div>
        </div>
    </section>
    <div id="landingpage">
        <section class="outer">
            <article class="articles">
                @foreach($articles as $article)
                    <article class="article" itemscope itemprop="blog" data-scroll-reveal>
                        <div class="article-inner">
                            <header class="article-header">
                                <h2 itemprop="name">
                                    <a href="{{ $article->url }}" class="article-title">{{ $article->title }}</a>
                                </h2>
                                @if($article->is_top === 1)
                                    <div class="article-topping">
                                        <i class="fe icon-umbrella"></i>
                                    </div>
                                @endif
                            </header>
                            <div class="article-meta">
                                <div class="article-date">{{ $article->created_at->format('Y-m-d') }}</div>
                                <div class="article-category">
                                    <a href="{{$article->category->url}}">{{ $article->category->name }}</a>
                                </div>
                            </div>
                            <div class="article-entry" itemprop="articleBody">
                                @if(!is_null($article->cover))
                                    <div class="article-gallery">
                                        <div class="article-gallery-photos">
                                            <a href="{{ $article->url }}">
                                                <img src="{{ $article->cover }}" alt="{{$article->title}}">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                <p>
                                    {!! $article->des !!}
                                </p>
                                <p>
                                    <a class="article-more-link" href="{{ $article->url }}">Read More</a>
                                </p>

                            </div>
                            <div class="article-footer">
                                @if(count($article->tags))
                                    <ul class="article-tag-list">
                                        @foreach($article->tags as $tagItem)
                                            <li class="article-tag-list-item">
                                                <a href="{{ $tagItem->url }}"
                                                   class="article-tag-list-link">{{ $tagItem->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="fe icon-smile-alt">{{ $article->views }}</div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </article>
            {{ $articles->links('app.pagination') }}
        </section>
    </div>
@endsection
