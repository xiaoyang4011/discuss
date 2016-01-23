@extends('app')

@section('title')

@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 class="jumbotron__heading">注册码列表
                <a href="/make_register_code" class="btn btn-primary">
                    <i class="fa fa-bolt"></i>
                    生成注册码
                </a>
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                <table class="table">
                    <thead>
                        <tr>
                            <th>注册码</th>
                            <th>状态</th>
                            <th>注册ID</th>
                            <th>更新时间</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(count($code_list) > 0)
                    @foreach($code_list as $code)

                        <tr class="@if($code->status) warning @else success @endif">
                            <td>{{ $code->register_code }}</td>
                            <td>
                            @if($code->status)
                                    已被使用
                                @else
                                    未被使用
                            @endif
                            </td>
                            <td>
                                @if($code->use_user_id)
                                    {{ $code->use_user_id }}
                                @else
                                    未被注册
                                @endif
                            </td>
                            <td>{{ $code->updated_at }}</td>
                        </tr>
                    @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop