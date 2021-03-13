<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Video;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    private const STORAGE_PATH = 'videos';

    public function create(string $courseId)
    {
        $course = Course::query()->findOrFail($courseId);
        return view('video/create', ['course' => $course]);
    }

    public function store(Request $request, string $courseId)
    {
        $request->validate([
            'title' => ['required'],
            'file' => ['required', 'file'],
            'unit' => ['required']
        ]);

        $course = Course::findOrFail($courseId);
        $unit = $course->units()->findOrFail($request->unit);

        $path = self::STORAGE_PATH;
        $storageName = Uuid::uuid().".{$request->file('file')->extension()}";

        $video = new Video();

        $video->title = $request->title;
        $video->path = "$path/$storageName";
        $video->unit()->associate($unit);

        $video->save();

        $request->file('file')->storeAs($path, $storageName);

        return redirect(route('courses.view', ['id' => $courseId]));
    }

    public function get(string $courseId, string $videoId)
    {
        $video = Video::findOrFail($videoId);

        return Storage::get($video->path);
    }
}
