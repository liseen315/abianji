@foreach($iteration as $year => $posts)
    <div class="archives-wrap">
        <div class="archive-year-wrap">
            <a href="{{ route('home.archives.year',$year) }}" class="archive-year">{{ $year }}</a>
        </div>
        <div class="archives">
            @foreach($posts as $article)
                <article class="archive-article">
                    <div class="archive-article-inner">
                        <header class="archive-article-header">
                            <a href="javascript:void(0);"
                               class="archive-article-date">{{ $article->created_at->format('m/d') }}</a>
                            <h2>
                                <a href="{{ $article->url }}" class="archive-article-title">{{ $article->title }}</a>
                            </h2>
                        </header>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endforeach
