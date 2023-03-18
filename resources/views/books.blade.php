@extends('layout')

@section('content')

<div
    class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4"
>

    @unless(count($books) === 0)
        <table id="myTable">
            <head>
                <tr>
                    <th>Title</th>
                    <th>Number</th>
                    <th>Description</th>
                </tr>
            </head>
            <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{$book->title}}</td>
                    <td>{{$book->number}}</td>
                    <td>{{$book->description}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No books found</p>
    @endunless

</div>

@endsection
