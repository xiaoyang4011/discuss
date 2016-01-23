@extends('app')
@section('title')
    登陆
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 class="jumbotron__heading">Navbar example</h2>
        </div>
    </div>
    <div class="col-md-3 col-md-offset-4">

        <a  class="btn btn-lg btn-primary">
            <i class="fa fa-check"></i>
            {{ $msg }}
        </a>

    </div>
@stop