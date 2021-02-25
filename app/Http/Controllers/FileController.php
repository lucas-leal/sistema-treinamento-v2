<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\File;
use App\Models\Unit;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function create(string $courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('file/create', ['course' => $course]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit' => 'required',
            'file' => ['required', 'file']
        ]);

        $unit = Unit::findOrFail($request->unit);

        $file = new File();

        $file->title = $request->file('file')->getClientOriginalName();
        $file->path = 'test';
        $file->unit()->associate($unit);
        $file->course()->associate($unit->course);

        $file->save();

        return $request->file('file')->storeAs('', $file->id);
    }
}
