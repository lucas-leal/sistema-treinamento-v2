<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::where([])->get();

        return view('welcome', ['courses' => $courses]);
    }
}
