@extends('app')
@section('title')
<title>
    搜索列表-爱生活，锲而不舍
</title>
@stop
 
 
@include('articles.nav')

@section('content')
    @if($searchList)
    	@foreach($searchList as $k=>$v)
            <div class="bs-callout bs-callout-warning" id="callout-tables-responsive-overflow" style="margin-top:30px;">
                <h4><a href="{{url('articles',$v['id'])}}">{{$v['title']}}</a></h4>
                <div class="post-content">
                	{!!mb_substr(strip_tags($v['content']),0,200,'utf-8')!!}
                </div>
            </div>
    	@endforeach
    @else
    	<h2>没有查询到任何线索！<a href="http://laravel.suhanyu.top/articles/">返回首页</a></h2>
    	@if(isset($searchList[0]['message']))
    		{{ $searchList[0]['message'] }}
    	@endif
    @endif
@stop

