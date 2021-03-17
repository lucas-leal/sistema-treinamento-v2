<?php

namespace App\Http\Controllers;

use App\Models\Course;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', Course::STATUS_ACTIVE)->get();

        return view('welcome', ['courses' => $courses]);
    }
}
