@extends('app')
@section('title')
添加文章
@stop

@section('content')
<div class="col-md-8 col-md-offset-2">

{!! Form::open() !!}

    <div class="form-group">
       {!! Form::label('title','Title:') !!}
       {!! Form::text('title',null,['class'=>'form-control']) !!}
   </div>

    <div class="form-group">
       {!! Form::label('content','Content:') !!}
       {!! Form::textarea('content',null,['class'=>'form-control']) !!}
   </div>

   <div class="form-group">
       {!! Form::submit('发布',['class'=>'btn btn-success form-control']) !!}
   </div>

{!! Form::close() !!}

</div>
@stop