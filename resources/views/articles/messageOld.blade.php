@extends('app')

@section('title')
    <title>爱生活|锲而不舍-访客留言</title>
@stop
@section('content')
    {{--markdown显示 Start--}}
    <link rel="stylesheet" href="http://pandao.github.io/editor.md/examples/css/style.css" />
    <link rel="stylesheet" href="http://pandao.github.io/editor.md/css/editormd.preview.css" />
    {{--markdown显示 End--}}



    <div class="container" style="margin-bottom: 20px;">
        @include('articles.nav')


        <!-- markedown来源 :http://www.codingdrama.com/bootstrap-markdown/  -->
        <div id="layout" class="row" style="margin-top: 20px;">
            <div id="editormd-message-content">
                            <textarea style="display: none;" id="append-test"  >

                            </textarea>
            </div>
        </div>

    </div>



    <script type="text/javascript" src="http://icon.zol-img.com.cn/public/js/jquery-1.11.min.js"></script>
    <!--  读markdown时引入js Start-->
    <script src="http://pandao.github.io/editor.md/lib/marked.min.js"></script>
    <script src="https://pandao.github.io/editor.md/lib/prettify.min.js"></script>
    <script src="https://pandao.github.io/editor.md/lib/raphael.min.js"></script>
    <script src="https://pandao.github.io/editor.md/lib/underscore.min.js"></script>
    <script src="https://pandao.github.io/editor.md/lib/sequence-diagram.min.js"></script>
    <script src="https://pandao.github.io/editor.md/lib/flowchart.min.js"></script>
    <script src="https://pandao.github.io/editor.md/lib/jquery.flowchart.min.js"></script>
    <script src="http://pandao.github.io/editor.md/editormd.js"></script>
    <!--  读markdown时引入js End-->

    <script type="text/javascript">
        //  /plugin/editor.md/lib/
        /*初始化编辑器*/
        var zEditor;
        $(function() {
            // markdown内容的显示
            var testEditormdView, testEditormdView2;
            //   http://pandao.github.io/editor.md/examples/test.md
            $.get("http://laravel.suhanyu.top/articles/message/9", function(markdown) {
                testEditormdView = editormd.markdownToHTML("editormd-message-content", {
                    markdown        : markdown ,//+ "\r\n" + $("#append-test").text(),
                    //htmlDecode      : true,       // 开启 HTML 标签解析，为了安全性，默认不开启
                    htmlDecode      : "style,script,iframe",  // you can filter tags decode
                    //toc             : false,
                    tocm            : true,    // Using [TOCM]
                    tocContainer    : "#custom-toc-container", // 自定义 ToC 容器层
                    //gfm             : false,
                    //tocDropdown     : true,
                    // markdownSourceCode : true, // 是否保留 Markdown 源码，即是否删除保存源码的 Textarea 标签
                    emoji           : true,
                    taskList        : true,
                    tex             : true,  // 默认不解析
                    flowChart       : true,  // 默认不解析
                    sequenceDiagram : true,  // 默认不解析
                });

                //console.log("返回一个 jQuery 实例 =>", testEditormdView);

                // 获取Markdown源码
                //console.log(testEditormdView.getMarkdown());

                //alert(testEditormdView.getMarkdown());
            });




        });


    </script>
@stop


@section('footer')
    @include('articles.footer')
@stop