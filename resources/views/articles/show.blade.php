@extends('app')
@section('title')
7csa
@stop

@section('content')
<h1> {{ $article->title }}</h1>

<article>

    <div class="body">
        {{ $article->content }}
    </div>
</article>
@endsection

@stop