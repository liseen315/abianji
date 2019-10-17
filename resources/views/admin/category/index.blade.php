@extends('layouts.admin')

@section('title','分类列表')

@section('bread-title','分类列表')

@section('content')
    @component('.admin.components.success')
    @endcomponent

    <div class="card">
        <div class="card-body">
            @if(count($categories) > 0 )
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                {{ $category->name }}
                                <div class="d-flex">
                                    <a href="{{ route('category.edit', $category->id) }}">
                                        <button type="button" class="btn btn-sm btn-primary mr-1 ">编辑</button>
                                    </a>

                                    <button type="button" class="btn btn-sm btn-danger J_delCategoryBtn"
                                            data-toggle="modal" data-target=".J_delCategoryModal"
                                            data-url="{{ route('category.delete', $category->id) }}"
                                            data-name="{{ $category->name }}">删除
                                    </button>
                                </div>
                            </div>
                            @if ($category->children->count() > 0)
                                <ul class="list-group mt-2">
                                    @foreach ($category->children as $child)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                {{ $child->name }}
                                                <div class="d-flex">
                                                    <a href="{{ route('category.edit',$child->id) }}">
                                                        <button type="button" class="btn btn-sm btn-primary mr-1">编辑
                                                        </button>
                                                    </a>

                                                    <button type="button" class="btn btn-sm btn-danger J_delCategoryBtn"
                                                            data-toggle="modal" data-target=".J_delCategoryModal"
                                                            data-url="{{ route('category.delete', $child->id) }}"
                                                            data-name="{{ $child->name }}">删除
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                暂无分类
                <a href="{{route('category.create')}}">去创建</a>
            @endif
        </div>
    </div>

    {{--Del Modal--}}

    <div class="modal fade J_delCategoryModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">删除标签</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body text-center">
                        <label class="category-name"></label>
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
            $('.J_delCategoryModal').on('show.bs.modal', function (e) {
                let name = $(e.relatedTarget).data('name');
                let url = $(e.relatedTarget).data('url');
                $(this).find('form').attr('action', url);
                $(this).find('.category-name').html('确认要删除 <span class="text-danger">' + name + '</span> 分类么?');
            })
        })
    </script>
@endsection
