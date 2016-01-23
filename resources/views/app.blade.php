<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ch">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<meta id="token" name="token" value="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/style.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/font-awesome.min.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/jquery.Jcrop.css') }}"/>
<link rel="stylesheet" href="{{ asset('/css/select2.css') }}"/>
<script src="{{ asset('/js/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jquery.form.js') }}"></script>
<script src="{{ asset('/js/jquery.Jcrop.min.js') }}"></script>
<script src="{{ asset('/js/vue.min.js') }}"></script>
<script src="{{ asset('/js/vue-resource.min.js') }}"></script>
<script src="{{ asset('/js/select2.full.min.js') }}"></script>
<title>@yield('title')</title>
</head>
<body>
<div class="body">

@include('nav')
@yield('content')
</div>
@include('footer')
</body>
</html>