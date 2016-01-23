@extends('app')
@section('title')
    撰写文章
@stop

@section('content')
@include('editor::head')
    <div class="jumbotron">
        <div class="container">
            <h2 class="jumbotron__heading">撰写文章</h2>
        </div>
    </div>
    <div class="col-md-8 col-md-offset-1" role="main">

        @if($errors->any())
            <ul class="list-group">

                <li class="list-group-item list-group-item-danger">{{ $errors->first() }}</li>

            </ul>
        @endif

        {!! Form::open(['url'=>'/discussion']) !!}

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
            {!! Form::label('tag_list','选择标签') !!}
            {!! Form::select('tag_list[]',$tags,null,['class'=>'form-control js-example-basic-multiple','multiple'=>'multiple']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('发布',['class'=>'btn btn-success form-control']) !!}
        </div>

        {!! Form::close() !!}

    </div>
<script type="text/javascript">
    $(function() {
        $(".js-example-basic-multiple").select2({
            placeholder: "添加标签"
        });
    });
</script>
@stop