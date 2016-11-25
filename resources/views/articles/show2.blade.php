@extends('app')

@section('title')
<title>
    {{$data->title}}
</title>

@stop

@section('content')
<style>
    .article-content{ max-width: 58em;margin:0 auto; font-size: 1.6rem;color: #3d464d;line-height: 30px;font-family: "Lantinghei SC","Open Sans",Arial,"Hiragino Sans GB","Microsoft YaHei",STHeiti,"WenQuanYi Micro Hei",SimSun,sans-serif; }

</style>
<link rel="stylesheet" href="http://pandao.github.io/editor.md/examples/css/style.css" />
<link rel="stylesheet" href="http://pandao.github.io/editor.md/css/editormd.preview.css" />
<div class="container-fluid">
    <div class="row">
        @include('articles.nav')
            <div class="article-content">
                <div class="page-header">
                    <h1>
                        {{$data->title}}
                    </h1>
                </div>
                <article>
                    <div class="content" id="main-content">
                        {!! $data->content !!}
                    </div>
                </article>
            </div>

    </div>
    @include('articles.footer')
</div>
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
        var testEditormdView, testEditormdView2;
        editormd.markdownToHTML("main-content", {
            htmlDecode      : "style,script,iframe",  // you can filter tags decode
            emoji           : true,
            taskList        : true,
            tex             : true,  // 默认不解析
            flowChart       : true,  // 默认不解析
            sequenceDiagram : true,  // 默认不解析
        });
    });

</script>
@stop