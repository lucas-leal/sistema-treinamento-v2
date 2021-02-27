<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\File;
use App\Models\Unit;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $path = 'files';
        $storageName = Uuid::uuid().".{$request->file('file')->extension()}";

        $file->title = $request->file('file')->getClientOriginalName();
        $file->path = "$path/$storageName";
        $file->unit()->associate($unit);
        $file->course()->associate($unit->course);

        $file->save();

        return $request->file('file')->storeAs($path, $storageName);
    }

    public function get(string $courseId, string $fileId)
    {
        $course = Course::findOrFail($courseId);
        $file = $course->files()->findOrFail($fileId);

        return Storage::download($file->path, $file->title);
    }
}
