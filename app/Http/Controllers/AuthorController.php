<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function getAll()
    {
        return view('authors');
    }

    // handle fetch all authors ajax request
    public function fetchAll() {
        return view('authors.index');
    }

    public function store(Request $request) {
        print_r($_POST);
    }
}
