@extends('layouts.admin')

@section('title','留言列表')

@section('bread-title','留言列表')

@section('content')
    @component('.admin.components.success')
    @endcomponent

    <table class="table table-bordered table-striped table-hover table-condensed"
           @if(count($comments) > 0) style="table-layout: fixed;" @endif>
        <tr>
            <th style="width: 8%;">ID</th>
            <th>所属文章</th>
            <th>评论人</th>
            <th>评论内容</th>
            <th style="width: 8%;">操作</th>
        </tr>
        @if(count($comments) > 0)
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->article->title }}</td>
                    <td>{{ $comment->nick_name }}</td>
                    <td>{{ get_description($comment->content,50) }}</td>
                    <td>
                        <button type="button" class="btn btn-primary btn-danger" data-toggle="modal"
                                data-url="{{ route('comment.delete',$comment->id) }}"
                                data-target=".J_delCommentModal">删除
                        </button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr style="text-align: center;">
                <td colspan="14">暂无留言</td>
            </tr>
        @endif
    </table>

    <div class="container">
        <div class="row justify-content-end">
            {{ $comments->links() }}
        </div>
    </div>

    <div class="modal fade J_delCommentModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">删除评论</h5>
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
            $('.J_delCommentModal').on('show.bs.modal', function (e) {
                let url = $(e.relatedTarget).data('url');
                $(this).find('form').attr('action', url);
                $(this).find('.article-name').html('确认要删除此条评论么?');
            })
        })
    </script>
@endsection
