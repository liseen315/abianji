@extends('layouts.admin')

@section('title','站点配置')

@section('bread-title','编辑配置')

@section('content')
    @component('.admin.components.error')
    @endcomponent

    @component('.admin.components.success')
    @endcomponent

    <div class="card">
        <div class="card-body">
            <form action="{{ route('config.update') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @foreach($configs as $config)
                    <div class="form-group">
                        <label>{{ $config->name }}</label>
                        @if($config->type === 'text')
                            <input type="text" name="{{$config->title}}" class="form-control"
                                   value="{{ $config->value }}">
                        @elseif($config->type === 'textarea')
                            <textarea name="{{$config->title}}" class="form-control">{{$config->value}}</textarea>
                        @else
                            <div class="container">
                                <div class="row">
                                    <div class="form-check col-auto">
                                        <input class="form-check-input" type="radio" name="{{$config->title}}" value="1"
                                               id="radio">
                                        <label class="form-check-label" for="radio">是</label>
                                    </div>
                                    <div class="form-check col-auto">
                                        <input class="form-check-input" type="radio" name="{{$config->title}}" value="0"
                                               id="radio" checked>
                                        <label class="form-check-label" for="radio">否</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach

                <div class="form-group">
                    <div class="container">
                        <div class="row justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                更新配置
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

