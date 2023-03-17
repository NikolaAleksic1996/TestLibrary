<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show register form
    public function create() {
        return view('users.register');
    }

    //register user new user
    public function register(Request $request) {
        $formData = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

//        hash password
        $formData['password'] = bcrypt($formData['password']);

        //create user and automatic login

        $user = User::create($formData);

        //automatic login
        auth()->login($user);

        return redirect('/')->with('message', 'Successfully register!');
    }
}
