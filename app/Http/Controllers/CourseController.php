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

    public function view(Request $request, string $id)
    {
        $course = Course::findOrFail($id);
        $evaluations = $course->evaluations()->limit(3)->get();
        $registration = $course->registrations()->where('user_id', $request->user()->id)->first();

        return view('course/view', [
            'course' => $course,
            'evaluations' => $evaluations,
            'registration' => $registration,
        ]);
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

        return redirect('/courses')
            ->with(['message' => 'Course registered with success!', 'style' => 'bg-success'])
        ;
    }

    public function inProgress(Request $request)
    {
        $registrations = $request->user()->registrations;

        $inProgress = [];
        foreach ($registrations as $registration) {
            if ($registration->isInProgress()) {
                $inProgress[] = $registration->course;
            }
        }

        return view('course/in-progress', ['courses' => $inProgress]);
    }

    public function concluded(Request $request)
    {
        $registrations = $request->user()->registrations;

        $concluded = [];
        foreach ($registrations as $registration) {
            if ($registration->isConcluded()) {
                $concluded[] = $registration->course;
            }
        }

        return view('course/concluded', ['courses' => $concluded]);
    }

    public function activate(string $id)
    {
        $course = Course::findOrFail($id);
        $course->status = Course::STATUS_ACTIVE;
        $course->save();

        return redirect()
            ->route('courses.view', ['id' => $id])
            ->with(['message' => 'Course activated with success!', 'style' => 'bg-success'])
        ;
    }

    public function inactivate(string $id)
    {
        $course = Course::findOrFail($id);
        $course->status = Course::STATUS_INACTIVE;
        $course->save();

        return redirect()
            ->route('courses.view', ['id' => $id])
            ->with(['message' => 'Course inactivated with success!', 'style' => 'bg-success'])
        ;
    }
}
