@extends('app')

@section('title')
<title>爱生活|锲而不舍-访客留言展示</title>
@stop
@section('content')
    {{--markdown显示 Start--}}
    <link rel="stylesheet" href="http://pandao.github.io/editor.md/examples/css/style.css" />
    <link rel="stylesheet" href="http://pandao.github.io/editor.md/css/editormd.preview.css" />
    {{--markdown显示 End--}}

    <div class="container" style="margin-bottom: 20px;">
        <div id="layout" class="row" style="margin-top: 20px;">
            <h2>留言列表</h2>
            @foreach($dataList as $k=>$v)
                <div class="media">
                    <div class="media-left">
                        <a href="javascript:void(0)">
                            <img class="media-object" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTU3NThmOGZkZCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NTc1OGY4ZmRkIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{$v['username']}}<small class="label label-info">{{$v['created_at']}}</small></h4>
                        <div id="message-content-{{$k}}">
                            <textarea style="display: none;" class="message-content"  >{!! trim($v['message']) !!}</textarea>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>

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
            $('#layout .media').each(function(index,ele){
                editormd.markdownToHTML("message-content-"+index, {
                    // markdown        : $('#message-content-'+index+' textarea').html() ,//+ "\r\n" + $("#append-test").text(),
                    htmlDecode      : "style,script,iframe",  // you can filter tags decode
                    emoji           : true,
                    taskList        : true,
                    tex             : true,  // 默认不解析
                    flowChart       : true,  // 默认不解析
                    sequenceDiagram : true,  // 默认不解析
                });
                //console.log(testEditormdView2.getMarkdown());
            });
        });

    </script>
@stop
