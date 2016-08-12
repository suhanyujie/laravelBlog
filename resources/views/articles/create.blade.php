@extends('app')
@section('content')
@include('UEditor::head')

<div class="container">
    <h1> 撰写新文章 </h1>
    <div class="row" style="margin-top:50px;">
        {!! Form::open(['url'=>'/articles']) !!}

        	@include('articles.form',['initContent'=>'',])

        <!-- 实例化编辑器 -->
        <script type="text/javascript">
            var ue = UE.getEditor('container');
            ue.ready(function() {
                ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                var articleDataKey = 'ueditor_preference';
                var dataStr = localStorage.getItem(articleDataKey);
                var dataObj = UE.utils.str2json(dataStr);
                if(dataObj){
                    for(var eleKey in dataObj){
                        ue.setContent(dataObj[eleKey],true);
                    }
                }
            });

        </script>
        {!! Form::close() !!}
        @if($errors->any())
            <ul class="list-group">
            @foreach($errors->all() as $error)
                <li class="list-group-item list-group-item-danger">{{$error}}</li>
            @endforeach
            </ul>
        @endif
    </div>

</div>
<script>

var articleDataKey = 'ueditor_preference';
// 加载localstorage数据到编辑器中
if(typeof(ue) != 'undefined' && false){
    var dataStr = localStorage.getItem(articleDataKey);
    // var dataObj = ue.UE.utils.str2json(dataObj);
    var dataObj = UE.utils.str2json(dataStr);

    if(dataObj){
        console.log(dataObj);
        for(eleKey in dataObj){
            // dataObj[eleKey]
            ue.setContent('<p>123</p>');
            break;
        }
    }
}
if($('.publish-article').length > 0){
    //删除本地的localstorage
    $('.publish-article').click(function(){
        localStorage.removeItem(articleDataKey);
    });
}

</script>

@stop

