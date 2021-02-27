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
    private const STORAGE_PATH = 'files';

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

        $path = self::STORAGE_PATH;
        $storageName = Uuid::uuid().".{$request->file('file')->extension()}";

        $file->title = $request->file('file')->getClientOriginalName();
        $file->path = "$path/$storageName";
        $file->unit()->associate($unit);

        $file->save();

        $request->file('file')->storeAs($path, $storageName);

        return redirect(route('courses.view', ['id' => $unit->course->id]));
    }

    public function get(string $courseId, string $fileId)
    {
        $file = File::findOrFail($fileId);

        return Storage::download($file->path, $file->title);
    }
}
