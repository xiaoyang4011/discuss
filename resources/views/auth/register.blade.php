@extends('app')
@section('title')
注册
@stop

@section('content')
<div class="jumbotron">
    <div class="container">
        <h2 class="jumbotron__heading">注册</h2>
    </div>
</div>
<div class="col-md-4 col-md-offset-4">

    @if($errors->any())
        <ul class="list-group">

                <li class="list-group-item list-group-item-danger">{{ $errors->first() }}</li>

        </ul>
    @endif

{!! Form::open() !!}

    <div class="form-group">
       {!! Form::label('name','用户名:') !!}
       {!! Form::text('name',null,['class'=>'form-control']) !!}
   </div>

    <div class="form-group">
       {!! Form::label('email','邮箱:') !!}
       {!! Form::email('email',null,['class'=>'form-control']) !!}
   </div>

    <div class="form-group">
        {!! Form::label('register_code','邀请码:') !!}
        {!! Form::text('register_code',null,['class'=>'form-control']) !!}
    </div>

   <div class="form-group">
        {!! Form::label('password','密码:') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
   </div>

  <div class="form-group">
       {!! Form::label('password_confirmation','确认密码:') !!}
       {!! Form::password('password_confirmation',['class'=>'form-control']) !!}
  </div>

   <div class="form-group">
       {!! Form::submit('注册',['class'=>'btn btn-success form-control']) !!}
   </div>

{!! Form::close() !!}

</div>
@stop