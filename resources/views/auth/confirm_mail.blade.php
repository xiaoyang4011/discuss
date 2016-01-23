@extends('app')
@section('title')
    登陆
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 class="jumbotron__heading">Navbar example
                <a href="/discussion/create" class="btn btn-primary">
                    <i class="fa fa-paper-plane"></i>
                    撰写问题
                </a>
            </h2>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4">

        <a  class="btn btn-lg btn-primary">
            <i class="fa fa-paper-plane"></i>
            邮件已发送到您的邮箱,请注意查收
        </a>

    </div>
@stop