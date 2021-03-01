<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::whereDoesntHave('users', function (Builder $query) {
            $query->where('users.id', Auth::id());
        })->get();

        return view('welcome', ['courses' => $courses]);
    }
}
