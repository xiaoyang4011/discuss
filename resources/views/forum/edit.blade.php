@extends('app')
@section('title')
    编辑文章
@stop

@section('content')
@include('editor::head')

    <div class="jumbotron">
        <div class="container">
            <h2 class="jumbotron__heading">编辑文章</h2>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-1" role="main">

        @if($errors->any())
            <ul class="list-group">

                <li class="list-group-item list-group-item-danger">{{ $errors->first() }}</li>

            </ul>
        @endif

        {!! Form::model($discussion, ['method' => 'PATCH','url' => '/discussion/'.$discussion->id]) !!}

        <div class="form-group">
            {!! Form::label('title','标题:') !!}
            {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            <div class="editor">
                {!! Form::label('body','内容:') !!}
                {!! Form::textarea('body',null,['class'=>'form-control','id'=>'myEditor']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('更新',['class'=>'btn btn-success form-control']) !!}
        </div>

        {!! Form::close() !!}

    </div>
@stop