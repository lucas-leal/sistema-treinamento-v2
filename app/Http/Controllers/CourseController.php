<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('course/index', ['courses' => $courses]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('course/create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'instructor' => ['required'],
            'keywords' => ['required'],
            'category' => ['required']
        ]);

        $course = new Course();

        $course->title = $request->title;
        $course->instructor = $request->instructor;
        $course->keywords = $request->keywords;

        $category = Category::find($request->category);
        $course->category()->associate($category);

        $course->save();

        return redirect('/courses');
    }
}
