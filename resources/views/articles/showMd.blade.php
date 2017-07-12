@extends('app')

@section('title')
<title>
    {{$data->title}}
</title>

@stop

@section('content')

<link rel="stylesheet" href="//laravel.suhanyu.top/plugin/editor.md/css/editormd.min.css" />
<style>
    .article-content,#main{ max-width: 58em;margin:0 auto; font-size: 1.6rem;color: #3d464d;line-height: 30px;
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
                    <div class="content" style="display:none;">
                        <textarea id="main-content">{!! $data->content !!}</textarea>
                    </div>
                </article>
            </div>
        <!-- 多说评论框 start -->
        <div class="ds-thread" data-thread-key="{{$data->id}}" data-title="{{$data->title}}" data-url="http://laravel.suhanyu.top/articles/{{$data->id}}"></div>
        <!-- 多说评论框 end -->
    </div>

    <!-- 多说公共JS代码 start (一个网页只需插入一次) -->
    <div class="row" style="width:70%;margin:0 auto;">
        <div id="comment-container"></div>
    </div>
    <link rel="stylesheet" href="https://imsun.github.io/gitment/style/default.css">
    <script src="https://imsun.github.io/gitment/dist/gitment.browser.js"></script>
    <script>
        var gitment = new Gitment({
            id: "{{$data->id}}", // 可选。默认为 location.href
            owner: 'suhanyujie',
            repo: 'selfBlog',
            oauth: {
                client_id: 'a7a5719c5c5df45f7558',
                client_secret: '6b7ef0781a83f320919f0910c998de691d8c00c5',
            },
        })
        gitment.render('comment-container')
    </script>
    <!-- 多说公共JS代码 end -->

    @include('articles.footer')
</div>
@if($data->id > 127)
<!--  读markdown时引入js Start-->
<script src="/plugin/editor.md/lib/marked.min.js"></script>
<script src="/plugin/editor.md/lib/prettify.min.js"></script>
<script src="/plugin/editor.md/lib/raphael.min.js"></script>
<script src="/plugin/editor.md/lib/underscore.min.js"></script>
<script src="/plugin/editor.md/lib/sequence-diagram.min.js"></script>
<script src="/plugin/editor.md/lib/flowchart.min.js"></script>
<script src="/plugin/editor.md/lib/jquery.flowchart.min.js"></script>
<script src="/plugin/editor.md/editormd.js"></script>
<!--  读markdown时引入js End-->
<script type="text/javascript">
    //  /plugin/editor.md/lib/
    $(function() {
        // markdown内容的显示
        var testEditormdView;

        testEditormdView = editormd.markdownToHTML("main", {
//            markdown        : $('#main-content').html(),// + $("#append-test").text(),
            htmlDecode: "style,script,iframe",  // you can filter tags decode
            emoji: true,
            taskList: true,
            tex: true,  // 默认不解析
            flowChart: true,  // 默认不解析
            sequenceDiagram: true,  // 默认不解析
            codeFold: true
        });

    });

</script>
    @endif

@stop