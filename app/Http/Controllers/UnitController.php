<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Unit;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UnitController extends Controller
{
    public function create(string $courseId)
    {
        $course = $this->findCourse($courseId);

        return view('unit/create', ['course' => $course]);
    }

    public function store(Request $request, string $courseId)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $course = $this->findCourse($courseId);

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->course()->associate($course);

        $unit->save();
    }

    private function findCourse(string $courseId): Course
    {
        $course = Course::find($courseId);
        
        if (!$course) {
            throw new BadRequestHttpException('Invalid course id');
        }

        return $course;
    }
}
