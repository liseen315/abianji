@extends('layouts.admin')

@section('title','标签列表')

@section('bread-title','标签列表')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table table-bordered table-striped table-hover table-condensed">
        <tr>
            <th style="width: 10%;">ID</th>
            <th>标签名</th>
            <th style="width: 15%; text-align: center;">操作</th>
        </tr>
        @if(count($tags) > 0)
            @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-sm btn-primary mr-1 J_editBtn" data-id="{{ $tag->id }}">
                            编辑
                        </button>
                        <button type="button" class="btn btn-sm btn-danger J_delTagBtn" data-id="{{ $tag->id }}"
                                data-name="{{ $tag->name }}" data-toggle="modal" data-target=".J_delModal">删除
                        </button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr style="text-align: center;">
                <td colspan="14">暂无标签 <a href="{{ route('tag.create') }}">去创建</a></td>
            </tr>
        @endif
    </table>

    {{--Del Modal--}}
    <div class="modal fade J_delModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">删除标签</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <label class="tag-name"></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="button" class="btn btn-primary del-confirm">确认</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {


            $('.J_delModal').on('show.bs.modal', function (e) {
                $(this).find('.del-confirm').attr('data-id', $(e.relatedTarget).data('id'));
                $(this).find('.tag-name').html('确定要删除' + $(e.relatedTarget).data('name') + '标签么?');
            });

            $('.del-confirm').on('click', function (e) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('tag.delete') }}',
                    dataType: 'json',
                    data: {id: $(e.target).data('id')},
                    success: function (response) {
                        $('.J_delModal').modal('hide');
                        if (response.status === 0) {
                            toastr.success(response.msg);
                            setTimeout(function () {
                                location.reload();
                            }, 1000);

                        } else {
                            toastr.error(response.msg);
                        }


                    }
                })
            });
        })
    </script>
@endsection