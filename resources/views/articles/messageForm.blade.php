@extends('app')

@section('title')
    <title>爱生活|锲而不舍-访客留言</title>
@stop
@section('content')
    <link rel="stylesheet" href="https://pandao.github.io/editor.md/lib/codemirror/codemirror.min.css" />
    <link rel="stylesheet" href="https://pandao.github.io/editor.md/css/editormd.min.css" />

    <div class="container" style="margin-bottom: 20px;">
        @include('articles.nav')
        <h2>尚未实现,请耐心等待哦~  </h2>
        <div class="row">
            {!! Form::open(['url' => '/articles/message','method'=>'post']) !!}
            <div class="form-group">
                {!! Form::label('username', '您的昵称(nickname)') !!}
                {!! Form::text('username',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', '您的邮箱(E-Mail)') !!}
                {!! Form::text('email',null,['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('content', '留言内容(message)') !!}
                <div id="text">
                    {!! Form::textarea('message',null,['id'=>'messageMdEditor','class'=>'form-control','style'=>'display:none','placeholder'=>'请输入留言吧~']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::submit('提交留言(submit)',['class'=>'btn btn-default']) !!}
            </div>

            {!! Form::close() !!}
        </div>

        <!-- markedown来源 :http://www.codingdrama.com/bootstrap-markdown/  -->
        <hr>
        <div class="row">
            <iframe id="iframepage" class="row" frameborder="0" width="100%" height="100%" scrolling=no onLoad="iFrameHeight()" src="/articles/message" frameborder="0"></iframe>
            
            
        </div>
        
    </div>



    <script type="text/javascript" src="http://icon.zol-img.com.cn/public/js/jquery-1.11.min.js"></script>
    {{--<script src="/plugin/editormd/editormd.min.js"></script>--}}
    <script src="http://zwiki.zol.com.cn/js/editor.md/lib/marked.min.js"></script>
    <script src="http://zwiki.zol.com.cn/js/editor.md/editormd.js"></script>
    <script type="text/javascript">
        function iFrameHeight() {
            var ifm= document.getElementById("iframepage");
            var subWeb = document.frames ? document.frames["iframepage"].document : ifm.contentDocument;
            if(ifm != null && subWeb != null) {
                ifm.height = subWeb.body.scrollHeight;
                ifm.width = subWeb.body.scrollWidth;
            }
        }
        //  /plugin/editor.md/lib/
        /*初始化编辑器*/
        var zEditor;
        $(function() {
            /**
             * 让外部链接新窗口打开
             */
            function setLinkTarget(){
                $('.editormd-preview').find('a').each(function(){
                    var $this = $(this);
                    var href = $this.attr('href');
                    if(!href) return;
                    if(href.indexOf('http://')>-1 || href.indexOf('https://')>-1) {
                        $this.attr('target','_blank');
                    }
                });
            }
            zEditor = editormd("text", {
                width   : '100%',
                height      : 340,
                float   : 'left',
                syncScrolling : "single",
                path    : "/plugin/editor.md/lib/",
                placeholder: "本编辑器支持分栏实时预览视图，左边编写，右边预览",
                emoji : false,
                imageUpload : true,
                imageFormats : ["jpg", "jpeg", "gif", "png"],
                //imageUploadURL : "/mdimage-upload.php",
                //tocStartLevel : 2,
                tocDropdown   : true,
                toolbarIcons : function() {
                    return [
                        "undo", "redo", "|",
                        "bold", "del", "italic", "quote", "ucwords", "uppercase", "lowercase", "|",
                        "h1", "h2", "h3", "h4", "h5", "h6", "|", "toc",
                        "list-ul", "list-ol", "pagebreak", "hr", "|",
                        "link", "reference-link","|", "image", "|",  "code", "preformatted-text", "code-block","table", "tmplApi","tmplDict","|", "datetime", /*"emoji",*/ "html-entities", "|",
                        "goto-line", "watch", "preview", "fullscreen", "clear", "search", "|",
                        "help", "|", "publish",'exitEdit'
                    ]

                },
                toolbarIconsClass : {
                    tmplApi : "fa-paper-plane",
                    tmplDict : "fa-database",
                    tmplApi : "fa-paper-plane",
                    publish : "fa-leanpub",
                    exitEdit : "fa-reply",
                    toc : "fa-navicon"
                },
                lang : {
                    toolbar : {
                        tmplApi : "插入API模板",
                        tmplDict : "插入数据库字典模板",
                        publish : '发布',
                        exitEdit: '退出',
                        toc: '插入目录'
                    }
                },
                // 用于增加自定义工具栏的功能，可以直接插入HTML标签，不使用默认的元素创建图标
                toolbarCustomIcons : {
                    //publish   : "<a href=\"javascript:;\" class=\"editor-pub editor-zol\" title=\"发布\" unselectable=\"on\"><i class=\"fa fa-leanpub\" name=\"publish\" unselectable=\"on\"></i>发布</a>",
                    //exitEdit   : "<a href=\"javascript:;\" class=\"editor-exit editor-zol\" title=\"退出\" unselectable=\"on\"><i class=\"fa fa-reply\" name=\"exitEdit\" unselectable=\"on\"></i>退出</a>"
                },

                // 自定义工具栏按钮的事件处理
                toolbarHandlers : {
                    /**
                     * @param {Object}      cm         CodeMirror对象
                     * @param {Object}      icon       图标按钮jQuery元素对象
                     * @param {Object}      cursor     CodeMirror的光标对象，可获取光标所在行和位置
                     * @param {String}      selection  编辑器选中的文本
                     */
                    tmplApi : function(cm, icon, cursor, selection) {
                        var tmpl = $("#api-doc-templ").html();
                        this.insertValue(tmpl);
                    },
                    tmplDict : function(cm, icon, cursor, selection) {
                        var tmpl = $("#database-doc-templ").html();
                        this.insertValue(tmpl);
                    },
                    publish : function(cm, icon, cursor, selection) {
                        $('#editor-form').attr('target','_self');
                        // 直接用from submit事件出现诡异情况，暂时用这个代替
                        $('.editor-sub').click();
                    },
                    exitEdit :function() {
                        location.href= docId ?'http://zwiki.zol.com.cn/index.php?doc-view-'+docId : 'http://zwiki.zol.com.cn/';
                    },
                    toc :function() {
                        this.insertValue('\n[TOC]\n');
                    }

                },
                onchange : function() {
                    setLinkTarget();
                },
                onload : function() {
                    setLinkTarget();
                }


            });

            //ctrl+s保存
            $(window).keydown(function(e) {
                if ( e.keyCode == 83 && (event.ctrlKey || event.metaKey) ) {
                    if( location.search && location.search.indexOf('doc-edit-')>0 ){
                        $('#editor-form').attr('target','hidetar');
                    } else {
                        $('#editor-form').attr('target','_self');
                    }
                    // 直接用from submit事件出现诡异情况，暂时用这个代替
                    $('.editor-sub').click();
                    e.preventDefault();
                    $('#savetip').fadeIn().delay(800).fadeOut();
                    return false;
                }
            });

            //粘贴上传url
            document.querySelector('#text').addEventListener('paste', function(e) {
                //判断是否是粘贴图片
                if (e.clipboardData && e.clipboardData.items[0].type.indexOf('image') > -1)
                {
                    var reader   = new FileReader();
                    file     = e.clipboardData.items[0].getAsFile();
                    //ajax上传图片
                    reader.onload = function(e)
                    {
                        var postData = {
                            file:this.result,
                            _token:"{{ csrf_token() }}"
                        }
                        // this.result得到图片的base64 (可以用作即时显示)
                        $.post('/upfile',postData,function(data){
                            if(data.linkurl){
                                zEditor.insertValue('![]('+data.linkurl+')');
                            }
                        },"json");
                    }
                    reader.readAsDataURL(file);
                }
            }, false);

        });


    </script>
@stop


@section('footer')
    @include('articles.footer')
@stop