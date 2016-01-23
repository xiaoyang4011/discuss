@extends('app')
@section('title')
登陆
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 class="jumbotron__heading">登陆</h2>
        </div>
    </div>
    <div class="col-md-4 col-md-offset-4">
        @if(Session::has('user_login_failed'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('user_login_failed') }}
            </div>
        @endif
{!! Form::open(['url'=>'/login']) !!}

    <div class="form-group">
       {!! Form::label('email','Email:') !!}
       {!! Form::email('email',null,['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
        {!! Form::label('password','Password:') !!}
        {!! Form::password('password',['class'=>'form-control']) !!}
   </div>
   <div class="form-group">
       {!! Form::submit('登陆',['class'=>'btn btn-success form-control']) !!}
   </div>


{!! Form::close() !!}

</div>
@stop