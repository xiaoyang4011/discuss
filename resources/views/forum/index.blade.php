@extends('app')

@section('title')

@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h2 class="jumbotron__heading">三人行, 必有我师
                <a href="/discussion/create" class="btn btn-primary">
                    <i class="fa fa-paper-plane"></i>
                    撰写问题
                </a>
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main">
                @foreach($discussions as $discussion)
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle transition" src="{{ $discussion->user->avatar }}" alt="10x10" style="height:60px">
                            </a>

                        </div>
                        <div class="media-body media-body-list">
                            <h4 class="media-heading">
                                <a href="/discussion/{{ $discussion->id }}">{{ $discussion->title }}</a>


                                    @if($discussion->tags)
                                        @foreach($discussion->tags as $tag)
                                            <a class="tag tag-sm"><i class="fa fa-tag"></i>{{ $tag->name }}</a>
                                        @endforeach
                                    @endif


                                <div class="media-conversation-meta">
                                    <span class="media-conversation-replies">
                                        <a href="">{{ count($discussion->comments) }}</a>
                                        回复
                                    </span>
                                </div>
                            </h4>

                            {{ $discussion->user->name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <nav class="nav-pagination col-md-4 col-md-offset-4">
        {!! $discussions->render() !!}
    </nav>
@stop
@if(isset($msg))
@section('msg')
    layer.msg('{{ $msg }}');
@stop
@endif