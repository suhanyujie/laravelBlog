@extends('app')
@section('title')
<title>
    文章列表-爱生活，锲而不舍
</title>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @include('articles.nav')
            @foreach($data['articles'] as $row)
            <div class="page-header">
                <h1>
                    <small><a href="{{url('articles',$row->id)}}">{{$row->title}}</a></small>
                    @if($data['userInfo'] && $data['userInfo']->name=='suhanyujie')
                        <a href="/articles/{{$row->id}}/edit" test="{{url('articles',$row->id)}}" class="btn btn-sm-warning">编辑</a>
                    @endif
                </h1>
            </div>
            @endforeach

        </div>
    </div>
</div>
@stop
@section('footer')
    @include('articles.footer')
@stop