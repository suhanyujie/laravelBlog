@extends('app')

@section('content')
<h3>People</h3>
@if(count($people)>0)
    @foreach($people as $row)
        <li>{{$row}}</li>
    @endforeach
@endif



@stop

@section('footer')
<scirpt>
    //alert('section:footer');
</scirpt>
@stop







