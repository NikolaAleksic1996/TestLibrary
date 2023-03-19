@extends('layout')

@section('content')
<h2>
    {{$book->title}}
</h2>
<p>{{$book->description}}</p>
<p>{{$book->number}}</p>
@endsection
