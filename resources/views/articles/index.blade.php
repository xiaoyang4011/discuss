@extends('app')
@section('title')
7csa.com
@stop

@section('content')
@foreach($articles as $article)
<article class="format-image group">
    <h2 class="post-title pad">
        <a font-size='11px' href="/articles/{{ $article->id }}"> {{ $article->title }}</a>
        <p></p>
    </h2>
    <ul class="post-meta pad group">
        <li><i class="fa fa-comments"></i><a href="/article/13#question-stats">32 评论</a></li>

            <li><i class="fa fa-clock-o"></i>23小时前 由 <a href="/user/frankstar"><strong>frankstar</strong></a>回复</li>

        <li><a href="/article/tags/controller" rel="category tag" class="tag tag-sm controller"><i class="fa fa-tag"></i> Controller</a></li>
    </ul>
    <div class="post-inner">
        <div class="post-deco">
            <div class="hex hex-small">
                <div class="hex-inner"><i class="fa"></i></div>
                <div class="corner-1"></div>
                <div class="corner-2"></div>
            </div>
        </div>
        <div class="post-content pad">
            <div class="entry custome">
                {{ $article->content }}
            </div>
            <a class="more-link-custom" href="/articles/{{ $article->id }}"><span><i>阅读全文</i></span></a>
        </div>
    </div>
</article>
@endforeach
@include('page')
@endsection

@stop