<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('course/index', ['courses' => $courses]);
    }

    public function view(string $id)
    {
        $course = Course::find($id);

        if (!$course) {
            throw new BadRequestHttpException('Course not found');
        }

        return view('course/view', ['course' => $course]);
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
            'description' => ['required'],
            'keywords' => ['required'],
            'category' => ['required']
        ]);

        $course = new Course();

        $course->title = $request->title;
        $course->description = $request->description;
        $course->instructor = $request->instructor;
        $course->keywords = $request->keywords;

        $category = Category::find($request->category);
        $course->category()->associate($category);

        $course->save();

        return redirect('/courses');
    }
}
