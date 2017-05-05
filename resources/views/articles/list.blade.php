@extends('app')
@section('title')
    <title>爱生活|锲而不舍-列表页|标签页</title>
@stop

@section('content')
<div class="container">
    @include('articles.nav')
    <main class="col-md-8 main-content">
        @if($dataList)
            @foreach($dataList as $row)
                <article id=52 class="post tag-laravel-5-1 tag-artisan">
                    <div class="post-head">
                        <h1 class="post-title">
                            <a href="{{url('articles',$row['id'])}}">{{$row['title']}}</a>
                        </h1>
                        <div class="post-meta">
                            <span class="author">作者：<a href="//weibo.com/u/1889337694">suhy</a></span>
                            &bull;
                            <time class="post-date" datetime="{{ $row['publish_date'] }}"
                                  title="{{ $row['publish_date'] }}">{{ $row['publish_date'] }}
                            </time>

                        </div>
                    </div>
                    <div class="post-content">
                        {!! mb_substr(strip_tags($row['content']),0,200,'utf-8') !!}
                    </div>
                    <div class="post-permalink">
                        <a href="{{url('articles',$row['id'])}}" class="btn btn-default">阅读全文</a>
                    </div>

                    <footer class="post-footer clearfix">
                        <div class="pull-left tag-list">
                            <span class='glyphicon glyphicon-eye-open' style="padding-left:10px;"><span style="padding-left:3px;">共有136人浏览</span></span>
                        </div>
                        <div class="pull-right share"></div>
                    </footer>
                </article>
            @endforeach
        @else
            <h2 style="color:red;">暂无相关文章</h2>
        @endif
    </main>
</div>
@stop
