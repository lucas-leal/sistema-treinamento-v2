<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function create(string $courseId)
    {
        $course = Course::findOrFail($courseId);

        return view('unit/create', ['course' => $course]);
    }

    public function store(Request $request, string $courseId)
    {
        $request->validate([
            'title' => 'required',
        ]);

        $course = Course::findOrFail($courseId);

        $unit = new Unit();
        $unit->title = $request->title;
        $unit->course()->associate($course);

        $unit->save();

        return redirect(route('courses.view', ['id' => $courseId]));
    }
}
