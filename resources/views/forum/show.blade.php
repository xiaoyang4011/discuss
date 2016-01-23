@extends('app')

@section('title')

@stop

@section('content')
    <div class="jumbotron">
        <div class="container">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object img-circle transition" src="{{ $discussion->user->avatar }}" alt="10x10" style="height:60px">
                    </a>

                </div>
                <div class="media-body media-body-show">
                    <h4 class="media-heading">{{ $discussion->title }}</h4>
                    {{ $discussion->user->name }}
                </div>
                @if(Auth::check() && Auth::user()->id == $discussion->user_id)
                <a href="/discussion/{{ $discussion->id }}/edit" class="btn btn-primary">
                    <i class="fa fa-paper-plane"></i>
                    修改文章
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-9" role="main" id="post">
                <div class="blog-post">
                    {!! $html !!}
                </div>
                <hr>

                @foreach($discussion->comments as $comment)
                    <div class="media">
                        <div class="media-left">
                            <a href="">
                                <img class="media-object img-circle" src="{{ $comment->user->avatar }}" alt="64x64" style="height:60px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"> {{ $comment->user->name }}</h4>
                            {{ $comment->body }}
                        </div>
                    </div>
                @endforeach
                @if(Auth::check())
                @if($discussion->comments->count() > 0)
                <div class="media" v-for="comment in comments">
                    <div class="media-left">
                        <a href="">
                            <img class="media-object img-circle" src="@{{ comment.avatar }}" alt="64x64" style="height:60px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"> @{{ comment.name }}</h4>
                        @{{ comment.body }}
                    </div>
                </div>
                <hr>
                @endif

                {!! Form::open(['url' => '/comment','v-on:submit'=>'onSubmitForm']) !!}
                {!! Form::hidden('discussion_id', $discussion->id) !!}
                <div class="form-group">
                    {!! Form::label('body', '评论:') !!}
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'v-model'=>'newComment.body']) !!}
                </div>
                <div>
                    {!! Form::submit('发表评论',['class'=>'btn btn-success pull-right']) !!}
                </div>
                {!! Form::close() !!}
                    @else
                    <div class="col-md-4 col-md-offset-3 login-comment">
                        <a href="/login" class="btn btn-black btn-success pull-right">登陆参与评论</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <script>
        @if(Auth::check())
        Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');
        new Vue({
            el : '#post',
            data : {
                comments : [],
                newComment : {
                    name : '{{ Auth::user()->name }}',
                    avatar : '{{ Auth::user()->avatar }}',
                    body : ''
                },
                newPost: {
                    discussion_id: '{{ $discussion->id }}',
                    user_id : '{{ Auth::user()->id }}',
                    body : ''
                }
            },
            methods: {
                onSubmitForm:function(e){
                    e.preventDefault();

                    var comment = this.newComment;
                    var post = this.newPost;

                    post.body = comment.body;
                    this.$http.post('/comment',post,function(){
                        this.comments.push(comment);
                    });

                    this.newComment = {
                        name : '{{ Auth::user()->name }}',
                        avatar : '{{ Auth::user()->avatar }}',
                        body : ''
                    };
                }
            }
        });
        @endif
    </script>
@stop