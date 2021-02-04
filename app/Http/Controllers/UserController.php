<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('user/index', ['users' => $users]);
    }

    public function create()
    {
        return view('user/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users'],
            'login' => ['required', 'min:6', 'unique:users'],
            'password' => ['required', 'min:6']
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->login = $request->login;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return redirect('/users');
    }
}
