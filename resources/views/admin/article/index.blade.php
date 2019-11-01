@extends('layouts.admin')

@section('title','文章列表')

@section('bread-title','文章列表')

@section('content')
    @component('.admin.components.success')
    @endcomponent

    <table class="table table-bordered table-striped table-hover table-condensed"
           @if(count($articles) > 0)style="table-layout: fixed;"@endif>
        <tr>
            <th style="width: 10%">ID</th>
            <th>标题</th>
            <th>所属分类</th>
            <th>点击数</th>
            <th>创建时间</th>
            <th style="width: 15%">操作</th>
        </tr>
        @if(count($articles) > 0)
            @foreach($articles as $article)
                <tr>
                    <td>{{ $article->id }}</td>
                    <td style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;">{{ $article->title }}</td>
                    <td>{{ $article->category ? $article->category->name : '暂无分类' }}</td>
                    <td>{{ $article->views }}</td>
                    <td>{{ $article->created_at }}</td>
                    <td>
                        <a href="{{ route('article.edit', $article->id ) }}">
                            <button type="button" class="btn btn-primary btn-primary mr-1">编辑</button>
                        </a>

                        <button type="button" class="btn btn-primary btn-danger" data-toggle="modal"
                                data-target=".J_delArticleModal" data-url="{{ route('article.delete',$article->id) }}"
                                data-name="{{ $article->title }}">删除
                        </button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr style="text-align: center;">
                <td colspan="14">暂无文章 <a href="{{ route('article.create') }}">去创建</a></td>
            </tr>
        @endif
    </table>

    <div class="container">
        <div class="row justify-content-end">
            {{ $articles->links() }}
        </div>
    </div>


    {{--Del Modal 这个可以抽离成组件等基础逻辑完成后抽离--}}
    <div class="modal fade J_delArticleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">删除文章</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body text-center">
                        <label class="article-name"></label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary del-confirm">确认</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.J_delArticleModal').on('show.bs.modal', function (e) {
                let name = $(e.relatedTarget).data('name');
                let url = $(e.relatedTarget).data('url');
                $(this).find('form').attr('action', url);
                $(this).find('.article-name').html('确认要删除 <span class="text-danger">' + name + '</span> 文章么?');
            })
        })
    </script>
@endsection
