<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class RegistrationController extends Controller
{
    public function subscribe(string $courseId, Request $request)
    {
        $course = Course::where('id', $courseId)
            ->where('status', Course::STATUS_ACTIVE)
            ->firstOrFail()
        ;

        $user = $request->user();

        if ($user->alreadyRegistered($course)) {
            throw new BadRequestHttpException('Already resgistered');
        }

        $registration = new Registration();
        $registration->user()->associate($user);
        $registration->course()->associate($course);
        $registration->save();

        return redirect()
            ->route('courses.view', ['id' => $course->id])
            ->with(['message' => 'Registration created with success!', 'style' => 'bg-success'])
        ;
    }
}
