<?php

namespace App\Http\Controllers;

use App\Models\Course;
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
        return $request->file('file')->getFilename();
    }
}
