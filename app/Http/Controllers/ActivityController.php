<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Course;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function create(string $courseId)
    {
        $course = Course::findOrFail($courseId);
        return view('activity/create', ['course' => $course]);
    }

    public function next(string $courseId, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'unit' => 'required',
            'questions' => ['required', 'numeric', 'min:1']
        ]);

        $course = Course::findOrFail($courseId);
        $unit = $course->units()->findOrFail($request->unit);

        return view('activity/questions-form', [
            'title' => $request->title,
            'questions' => $request->questions,
            'course' => $course,
            'unit' => $unit
        ]);
    }

    public function store(string $courseId, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'unit' => 'required',
            'questions' => ['required', 'numeric', 'min:1']
        ]);

        $this->validateQuestions($request);

        $course = Course::findOrFail($courseId);

        $this->save($course, $request);

        return redirect(route('courses.view', ['id' => $course->id]));
    }

    private function validateQuestions(Request $request)
    {
        $validationRules = [];

        for ($question = 1; $question <= $request->questions; $question++) {
            $validationRules["question-$question"] = 'required';
            $validationRules["correct-option-$question"] = 'required';

            for ($option = 1; $option <= Activity::NUMBER_OPTIONS; $option++) {
                $validationRules["option-$question-$option"] = 'required';
            }
        }

        $request->validate($validationRules);
    }

    private function save(Course $course, Request $request)
    {
        $unit = $course->units()->findOrFail($request->unit);

        $activity = new Activity();
        $activity->title = $request->title;
        $activity->unit()->associate($unit);
        $activity->save();

        for ($question = 1; $question <= $request->questions; $question++) {
            $questionModel = new Question();
            $questionModel->description = $request->get("question-$question");
            $questionModel->activity()->associate($activity);
            $questionModel->save();

            $options = [];

            for ($option = 1; $option <= Activity::NUMBER_OPTIONS; $option++) {
                $optionModel = new Option();
                $optionModel->description = $request->get("option-$question-$option");

                if ($request->get("correct-option-$question") === "option-$question-$option") {
                    $optionModel->correct = true;
                }

                $options[] = $optionModel;
            }

            $questionModel->options()->saveMany($options);
        }
    }

    public function view(string $courseId, string $activityId)
    {
        $course = Course::findOrFail($courseId);
        $activity = $course->activities()->findOrFail($activityId);

        return view('activity/view', ['activity' => $activity]);
    }

    public function renderResolutionForm(string $courseId, string $activityId)
    {
        $course = Course::findOrFail($courseId);
        $activity = $course->activities()->findOrFail($activityId);

        return view('activity/resolution', ['activity' => $activity]);
    }

    public function resolution(string $courseId, string $activityId, Request $request)
    {
        $course = Course::findOrFail($courseId);
        $activity = $course->activities()->findOrFail($activityId);

        $this->validateResolution($activity, $request);

        return $request->all();
    }

    private function validateResolution(Activity $activity, Request $request)
    {
        $rules = [];

        foreach ($activity->questions as $question) {
            $rules[$question->id] = 'required';
        }

        $request->validate($rules);
    }
}
