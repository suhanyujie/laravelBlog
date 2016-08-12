@extends('app')
@section('title')<title>{{$data->title}}</title>@stop
@section('content')
    <div class="container">
        <div class="row">
            <h1>{{$data->title}}</h1>

            <article>
                <div class="content">
                    {!! $data->content !!}
                </div>

            </article>

            <hr>

        </div>


    </div>

@stop