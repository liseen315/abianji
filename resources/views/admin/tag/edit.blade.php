@extends('layouts.admin')

@section('title','编辑标签')

@section('bread-title','编辑标签')

@section('content')
    @component('.admin.components.error')
    @endcomponent

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tag.update', $tag->id) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label>新标签名</label>
                    <input type="text" name="name" class="form-control" value="{{ $tag->name }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">更新标签</button>
                </div>
            </form>
        </div>
    </div>
@endsection

