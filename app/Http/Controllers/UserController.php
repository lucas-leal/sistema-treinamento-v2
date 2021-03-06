<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->where('admin', '!=', true);

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

        return redirect('/users')
            ->with(['message' => 'User registered with success!', 'style' => 'bg-success'])
        ;
    }

    public function report(string $id)
    {
        $user = User::findOrFail($id);
        return view('user/report', ['user' => $user]);
    }
}
