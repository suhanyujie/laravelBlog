@extends('app')

@section('title')
    <title>
        {{$data->title}}
    </title>

@stop

@section('content')
    <style>
        .article-content{ max-width: 58em;margin:0 auto; font-size: 1.6rem;color: #3d464d;line-height: 30px;
            font-family: "Lantinghei SC","Open Sans",Arial,"Hiragino Sans GB","Microsoft YaHei",STHeiti,"WenQuanYi Micro Hei",SimSun,sans-serif;
            border-bottom: 2px solid #ccc;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            @include('articles.nav')
            <div class="article-content">
                <div class="page-header">
                    <h1>
                        {{$data->title}}
                    </h1>
                </div>
                <article id="main">
                    <div class="content"  >{!! $data->content !!}</div>
                </article>
            </div>
            <!-- 多说评论框 start -->
            <div class="ds-thread" data-thread-key="{{$data->id}}" data-title="{{$data->title}}" data-url="http://laravel.suhanyu.top/articles/{{$data->id}}"></div>
            <!-- 多说评论框 end -->
        </div>

        <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
        <script type="text/javascript">
            var duoshuoQuery = {short_name:"ishenghuo"};
            (function() {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
        </script>
        <!-- 多说公共JS代码 end -->

        @include('articles.footer')
    </div>


@stop