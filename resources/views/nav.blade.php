<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">7csa</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="/">首页</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
          <li><a id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true">{{ Auth::user()->name }}</a>
            <ul class="dropdown-menu" aria-labelledby="dLabel">
              <li><a href="/avatar"> <i class="fa fa-user"></i> 更换头像</a></li>
              <li><a href="#"> <i class="fa fa-cog"></i> 更换密码</a></li>
              <li role="separator" class="divider"></li>
              <li> <a href="/logout">  <i class="fa fa-sign-out"></i> 退出登录</a></li>
            </ul>
          </li>
          <li class="nav-avatar"><img src="{{ Auth::user()->avatar }}" class="img-circle" width="42" alt=""></li>

        @else
          <li><a href="/login/">登陆</a></li>
          <li><a href="/register">注册</a></li>
        @endif
      </ul>
    </div>
  </div>
</nav>