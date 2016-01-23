@extends('app')
@section('title')
    更换头像
@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 class="jumbotron__heading">更换头像</h2>
        </div>
    </div>
    <div class="col-md-6 col-md-offset-3">
        <div class="text-center">
            <div id="validation-errors"></div>
            <img src="{{Auth::user()->avatar}}" width="120" class="img-circle" id="user-avatar" alt="">
            {!! Form::open(['url'=>'/avatar','files'=>true,'id'=>'avatar']) !!}
            <div class="text-center">
                <button type="button" class="btn btn-success avatar-button" id="upload-avatar">更换新的头像</button>
            </div>
            {!! Form::file('avatar',['class'=>'avatar','id'=>'image']) !!}
            {!! Form::close() !!}
            <div class="span5">
                <div id="output" style="display:none">
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open( [ 'url' => ['/crop/api'], 'method' => 'POST', 'onsubmit'=>'return checkCoords();','files' => true ] ) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #ffffff">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">裁剪头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="content">
                            <div class="crop-image-wrapper">
                                <img
                                        src="/images/default-avatar.png"
                                        class="ui centered image" id="cropbox" >
                                <input type="hidden" id="photo" name="photo" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-info">裁剪头像</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('/js/auth/user.js') }}"></script>
@stop
