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
                <div class="pull-right">
                    @if(\Auth::user())
                        <a href="{{url('articles/edit', ['id'=>$data->id])}}" class="btn btn-info">编辑</a>
                    @endif
                </div>
            </div>
            <article id="main">
                <div class="content" style="display:none;">
                    <textarea id="main-content">{!! $data->content !!}</textarea>
                </div>
            </article>
            <i>本文首发于"爱生活，锲而不舍"，转载请务必注明本文链接，版权必究！</i>
        </div>
    </div>

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
