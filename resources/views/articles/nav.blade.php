<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">

        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
        </button> <a class="navbar-brand" href="#">爱生活</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="active">
                <a href="http://laravel.suhanyu.top/">首页</a>
            </li>
            <li style="display:none;">
                <a href="#" class="disabled">Link</a>
            </li>
            <li class="dropdown" >
                <a href="http://tool.lu/" class="dropdown-toggle" data-toggle="dropdown">前端导航<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="http://tool.lu/">压缩/格式化</a>
                    </li>
                    <li>
                        <a href="http://tool.oschina.net/regex">在线正则</a>
                    </li>
                    <li>
                        <a href="https://www.debuggex.com/">在线正则2</a> 
                    </li>


                </ul>
            </li>
            <li class="dropdown" >
                <a href="http://tool.lu/" class="dropdown-toggle" data-toggle="dropdown">Laravel<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="http://oomusou.io/laravel/laravel-architecture/">laravel中大架构</a>
                    </li>
                    <li>
                        <a href="http://www.golaravel.com/laravel/docs/5.1/quickstart-intermediate/">laravel文档</a>
                    </li>
                    <li>
                        <a href="http://laravel-china.org/docs/5.1/eloquent-serialization">laravel全中文文档</a>
                    </li>
                    <li>
                        <a href="http://laravelbase.com/collections/1/36">laravel文档攻略</a>
                    </li>
                    <li>
                        <a href="http://laravelacademy.org/docs/laravel-5_1">laravel学院文档</a>
                    </li>
                    <li>
                        <a href="http://laravel.so/">laravel.so</a>
                    </li>
                    <li>
                        <a href="http://laravelacademy.org/post/153.html">laravel资源大全</a>
                    </li>
                    <li>
                        <a href="http://m.aoh.cc/1.html">laravel资源大全2</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown" >
                <a href="" class="dropdown-toggle" data-toggle="dropdown">设计模式<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="http://laravelacademy.org/post/2935.html">设计模式学习</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown" >
                <a href="" class="dropdown-toggle" data-toggle="dropdown">前沿<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="https://github.com/ThinkDevelopers/PHPConChina/tree/master/PHPCON2016">phpcon大会</a>
                    </li>
                    <li>
                        <a href="http://www.phpconchina.com/">phpcon官网</a>
                    </li>
                </ul>
            </li>


            <li class="dropdown">
                <a href="/articles/message/create" target="_self">留言</a>
            </li>
        </ul>
        {!! Form::open(['url' => '/articles/search','class'=>'navbar-form navbar-left','role'=>'search','method'=>'get']) !!}
<!--         <form class="navbar-form navbar-left" role="search" method="get" action="/articles/search/"> -->
            <div class="form-group">
                <input type="text" class="form-control" name="keywords">
            </div>
            <button type="submit" class="btn btn-default">
                Submit
            </button>
            {!! Form::close() !!}
<!--         </form> -->
        <ul class="nav navbar-nav navbar-right">
            <li style="display:none;">
                <a href="#" class="">Link</a>
            </li>
            @if(!\Auth::user())
            <li class="dropdown">
                <a href="#" class="dropdown-toggle " data-toggle="dropdown">登陆/注册<strong class="caret"></strong></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="/auth/login" target="_self">登录</a>
                    </li>
                    <li>
                        <a href="/auth/register" target="_self">注册</a>
                    </li>

                </ul>
            </li>
            @elseif(\Auth::user())
                <li style="" class="label label-info">
                    <span>您好,{{\Auth::user()->name}}</span>
                </li>
                <li class="label label-info">
                    <span><a href="/auth/logout" target="_self">退出</a></span>
                </li>
                <li class="label label-info">
                    <span><a href="/admin" target="_self">后台</a></span>
                </li>
            @endif
        </ul>
    </div>

</nav>