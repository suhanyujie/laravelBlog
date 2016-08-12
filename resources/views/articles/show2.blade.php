@extends('app')

@section('title')
<title>
    {{$data->title}}
</title>
<style>
    .article-content{ max-width: 58em;margin:0 auto; font-size: 1.6rem;color: #3d464d;line-height: 30px;font-family: "Lantinghei SC","Open Sans",Arial,"Hiragino Sans GB","Microsoft YaHei",STHeiti,"WenQuanYi Micro Hei",SimSun,sans-serif; }

</style>
@stop

@section('content')
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
                    <div class="content">
                        {!! $data->content !!}
                    </div>
                </article>
            </div>

    </div>
    @include('articles.footer')
</div>
@stop