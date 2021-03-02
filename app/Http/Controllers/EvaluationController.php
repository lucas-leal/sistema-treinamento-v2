<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function create(string $courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('evaluation/create', ['course' => $course]);
    }

    public function store(string $courseId, Request $request)
    {
        $request->validate([
            'score' => 'required',
            'comment' => 'required'
        ]);

        $course = Course::findOrFail($courseId);
        $user = Auth::user();

        $evaluation = new Evaluation();
        $evaluation->score = '';
        $evaluation->comment = '';
        $evaluation->course()->associate($course);
        $evaluation->user()->associate($user);
        $evaluation->save();

        return redirect(route('courses.view', ['id' => $course->id]));
    }
}
