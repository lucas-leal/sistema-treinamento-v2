<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function create(string $courseId)
    {
        $course = Course::query()->findOrFail($courseId);
        return view('video/create', ['course' => $course]);
    }

    public function store(Request $request, string $courseId)
    {
        $request->validate([
            'title' => ['required'],
            'url' => ['required'],
            'unit' => ['required']
        ]);

        $course = Course::findOrFail($courseId);
        $unit = $course->units()->findOrFail($request->unit);

        $video = new Video();

        $video->title = $request->title;
        $video->url = $request->url;
        $video->unit()->associate($unit);

        $video->save();

        return redirect(route('courses.view', ['id' => $courseId]));
    }
}
