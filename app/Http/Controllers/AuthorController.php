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
//        $emps = Author::all();
//        $output = '';
//        if ($emps->count() > 0) {
//            $output .= '<table class="table table-striped table-sm text-center align-middle">
//            <thead>
//              <tr>
//                <th>ID</th>
//                <th>Avatar</th>
//                <th>Name</th>
//                <th>email</th>
//                <th>Action</th>
//              </tr>
//            </thead>
//            <tbody>';
//            foreach ($emps as $emp) {
//                $output .= '<tr>
//                <td>' . $emp->id . '</td>
//                <td><img src="storage/images/' . $emp->avatar . '" width="50" class="img-thumbnail rounded-circle"></td>
//                <td>' . $emp->name . ' ' . $emp->last_name . '</td>
//                <td>' . $emp->email . '</td>
//                <td>
//                  <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editEmployeeModal"><i class="bi-pencil-square h4"></i></a>
//
//                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
//                </td>
//              </tr>';
//            }
//            $output .= '</tbody></table>';
//            echo $output;
//        } else {
//            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
//        }
        return view('authors.index');
    }

    public function store(Request $request) {
        print_r($_POST);
    }
}
