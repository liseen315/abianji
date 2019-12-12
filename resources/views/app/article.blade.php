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
                            <span id="J_commentNumber">{{ $commentsNum }}</span> 条评论
                        </div>
                        <div class="cm-user">
                            @if(!auth('socialite')->check())
                                <a class="login" href="{{ route('socialite.redirect',['github']) }}">登录</a>
                            @else
                                <div class="user-inner">
                                    <div class="user-name"> {{ auth('socialite')->user()->nick_name }}</div>
                                    <a href="{{ route('socialite.logout') }}" class="logout">登出</a>
                                </div>

                            @endif

                        </div>
                    </div>
                    <div class="cm-header">
                        @if(!auth('socialite')->check())
                            <div class="avatar">
                                <i class="icon-github"></i>
                            </div>
                        @else
                            <div class="avatar">
                                <img src="{{ auth('socialite')->user()->avatar }}" alt="头像">
                            </div>
                        @endif
                        <div class="header-comment">
                            <textarea class="header-textarea" placeholder="Leave a comment" id="J_textArea" data-userid="@if(auth('socialite')->check()){{  auth('socialite')->user()->openid }}@endif" data-article="{{ $article->id }}" data-parentid="0"></textarea>
                            <div class="header-preview markdown-body hide" id="J_previewMarkdown"></div>
                            <div class="header-controls">
                                <div class="tip"><i class="icon-warning"></i>推荐使用Markdown编写</div>
                                <div class="btn-group">
                                    @if(!auth('socialite')->check())
                                        <a href="{{ route('socialite.redirect',['github']) }}"
                                           class="option-btn login-btn">登录GitHub</a>
                                    @endif
                                    <div class="option-btn pre-btn" id="J_previewBtn">预览</div>
                                    <div class="option-btn editor-btn hide" id="J_previewEditorBtn">编辑</div>
                                    <div class="option-btn comment-btn  @if(!auth('socialite')->check()) hide @endif" id="J_commentBtn">发表</div>
                                    <div class="option-btn update-btn hide" id="J_updateCommentBtn">更新</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cm-comments">
                        <div class="cm-comment-list" id="J_commentList">

                        </div>
                        <div class="comments-controls">
                            <button class="option-btn load-more hide" id="J_loadMoreBtn">加载更多</button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>
@endsection

@section('scripts')
    <script>
        const previewAPI = '{{ route('home.preview') }}';
        const postCommentAPI = '{{ route('home.postcomment') }}';
    </script>
    <script type="text/javascript" src="{{ asset('assets/layer/layer.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/tocbot/tocbot.js') }}"></script>
    <script type="text/javascript" src="{{mix('js/home/article.js')}}"></script>
@endsection
