@include('UEditor::head')
@extends('app')
@section('title')
    <title>
        编辑文章： {{$articles->title}}
    </title>
@stop

@section('content')

    <div class="container">
        @include('articles.nav')
        <h1> 编辑文章 </h1>
        <div class="row" style="margin-top:50px;">
            {!! Form::model($articles,['method'=>'PATCH','url'=>'/articles/'.$articles->id]) !!}

            @include('articles.form',['initContent'=>$articles->content,])

                    <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                });
            </script>

            {!! Form::close() !!}

            @include('errors.articleError')

        </div>

    </div>
@stop

@section('footer')
    @include('articles.footer')
@stop