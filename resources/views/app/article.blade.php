@extends('layouts.frontend')
@section('title')
    {{ $article->title }}
@endsection

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
                    <div class="article-category">
                        <a href="{{ $article->category->url }}">{{ $article->category->name }}
                        </a>
                    </div>
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
                                    <a href="{{ $tagItem->url }}" class="article-tag-list-link">{{ $tagItem->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <a href="javascript:void(0);" data-url="{{ $article->url }}" class="article-share-link">分享</a>
                </div>
            </div>
            @if(!is_null($prev) || !is_null($next))
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
            @endif
            <div class="comments-box" id="J_commentBox">
                <div class="cm-container">
                    <div class="cm-meta">
                        <div class="cm-counts">
                            <span>159</span> 条评论
                        </div>
                        <div class="cm-user">
                            <a class="login" href="{{ route('socialite.redirect',['github']) }}">登录</a>
                        </div>
                    </div>
                    <div class="cm-header">
                        <div class="icon-github avatar"></div>
                        <div class="header-comment">
                            <textarea class="header-textarea" placeholder="Leave a comment"></textarea>
                            <div class="header-preview markdown-body hide" id="J_previewMarkdown"></div>
                            <div class="header-controls">
                                <div class="tip"><i class="icon-warning"></i>推荐使用Markdown编写</div>
                                <div class="btn-group">
                                    <a href="{{ route('socialite.redirect',['github']) }}" class="option-btn login-btn">登录GitHub</a>
                                    <div class="option-btn" id="J_previewBtn">预览</div>
                                    <div class="option-btn hide" id="J_previewEditorBtn">编辑</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cm-comments">
                        <div class="cm-comment-list">
                            <div class="cm-comment-list-item">
                                <div class="avatar">
                                    <img src="https://avatars1.githubusercontent.com/u/15714090?v=4" alt="">
                                </div>
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <div class="left-panel">
                                            <a href="javascript:void(0);" class="comment-username">Abianji</a>
                                            <span class="comment-text">发表于</span>
                                            <span class="comment-date">2019-10-10</span>
                                        </div>
                                        <div class="reply-panel">
                                            <div class="icon-comments replay-btn"></div>
                                        </div>
                                    </div>
                                    <div class="comment-body markdown-body">
                                        <p>支持一下!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comments-controls">
                            <button class="option-btn load-more" id="J_loadMoreBtn">加载更多</button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/tocbot/tocbot.js') }}"></script>
    <script type="text/javascript" src="{{mix('js/home/article.js')}}"></script>
@endsection
