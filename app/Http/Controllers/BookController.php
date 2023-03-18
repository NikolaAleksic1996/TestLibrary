<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function store(Request $request) {
        $bookData = [
            'title' => $request->title,
            'number' => $request->number,
            'description' => $request->description
        ];

        Book::create($bookData);
        return response()->json([
            'status' => 200
        ]);
    }
    //return all books
    public function fetchAll()
    {
        $books = Book::all();
        $output = '';
        if ($books->count() > 0) {
            $output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Number</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($books as $book) {
                $output .= '<tr>
                <td>' . $book->id . '</td>
                <td>' . $book->title . '</td>
                <td>' . $book->number . '</td>
                <td>' . $book->description . '</td>
                <td>
                  <a href="#" id="' . $book->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editBookModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $book->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    //edit book
    public function edit(Request $request) {
        $id = $request->id;
        $book = Book::find($id);
        return response()->json($book);
    }

    // handle update an book and store data to database
    public function update(Request $request) {
        $fileName = '';
        $book = Book::find($request->book_id);

        $bookData = [
            'title' => $request->title,
            'description' => $request->description,
            'number' => $request->number
        ];
        $book->update($bookData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete book
    public function delete(Request $request) {
        $id = $request->id;
        $book = Book::find($id);
        Book::destroy($id);
    }
}
