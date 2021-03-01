@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">{{ $resolution->calculateScore() }}%</h2>
            <h4 class="text-center">Here is your score.</h4>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('courses.view', ['id' => $resolution->activity->unit->course->id]) }}" class="btn btn-primary">Back to Course</a>
        </div>
    </div>

@endsection
