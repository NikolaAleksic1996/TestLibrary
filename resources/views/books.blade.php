@extends('layout')

@section('content')

<h1>{{$heading}}</h1>

@unless(count($books) === 0)
@foreach ($books as $book)
<h2><a href="/books/{{$book->id}}">{{$book->title}}</a></h2>
<p>{{$book->description}}</p>
<p>{{$book->number}}</p>
@endforeach
@else
    <p>No books found</p>
@endunless

@endsection
