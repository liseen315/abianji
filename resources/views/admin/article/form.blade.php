<form action="{{ $store }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="form-group">
        <label>选择分类</label>
        <div class="input-group">
            <select name="category_id" class="form-control select2">
                @foreach ($categories as $category)
                    @if(Route::currentRouteName() == 'article.create')
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}"
                                @if($article->category_id === $category->id) selected="selected" @endif>{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

    </div>
    <div class="form-group">
        <label>标题</label>
        @if(Route::currentRouteName() == 'article.create')
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
        @else
            <input type="text" class="form-control" name="title" value="{{ $article->title }}">
        @endif
    </div>

    <div class="form-group">
        <label>标签</label>
        <select class="form-group select2" style="width: 100%;" multiple="multiple" name="tag_list[]">
            @foreach($tags as $tag)
                @if(Route::currentRouteName() == 'article.create')
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @else
                    <option value="{{ $tag->id }}"
                            @if(in_array($tag->id,$checkTags)) selected="selected" @endif>{{ $tag->name }}</option>
                @endif

            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>文章封面</label>
        <div class="preview-box J_previewBox">
            <div class="preview-text J_previewText">文件预览窗口</div>
        </div>
        <div class="input-group cover-group">
            <input type="text" class="form-control cover-input J_coverLabel" disabled value="@if(Route::currentRouteName() == 'article.edit')  {{ $article->cover }} @endif">
            <input type="hidden" name="cover" class="J_inputCover" value="@if(Route::currentRouteName() == 'article.edit') {{ $article->cover }} @endif">
            <div class="btn btn-primary btn-file J_browseBox">
                <i class="fas fa-folder"></i>
                <span>浏览文件</span>
                <input type="file" class="file" id="J_ImgFile" accept="image/*">
            </div>
            <div class="btn-group J_optionBox">
                <div class="btn btn-secondary J_delBtn">
                    <i class="fas fa-trash-alt"></i>
                    <span>删除</span>
                </div>
                <div class="btn btn-secondary J_uploadBtn">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>上传</span>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>内容</label>
        <div id="J_articleContent">
            @if(Route::currentRouteName() == 'article.create')
                <textarea name="markdown">{{ old('markdown') }}</textarea>
            @else
                <textarea name="markdown">{{ $article->markdown }}</textarea>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label>是否置顶</label>
        <div class="container">
            <div class="row">
                <div class="form-check col-auto">
                    @if(Route::currentRouteName() == 'article.create')
                        <input class="form-check-input" type="radio" name="is_top" value="1" id="top">
                    @else
                        <input class="form-check-input" type="radio" name="is_top" value="1" id="top"
                               @if($article->is_top === 1) checked @endif>
                    @endif
                    <label class="form-check-label" for="top">置顶</label>
                </div>
                <div class="form-check col-auto">
                    @if(Route::currentRouteName() == 'article.create')
                        <input class="form-check-input" type="radio" name="is_top" value="0" id="unTop" checked>
                    @else
                        <input class="form-check-input" type="radio" name="is_top" value="0" id="unTop"
                               @if($article->is_top === 0) checked @endif>
                    @endif
                    <label class="form-check-label" for="unTop">取消置顶</label>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="container">
            <div class="row justify-content-end">
                <button type="submit" class="btn btn-primary">
                    @if(Route::currentRouteName() == 'article.create')
                        创建文章
                    @else
                        更新文章
                    @endif
                </button>
            </div>
        </div>
    </div>
</form>
