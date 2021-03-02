@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <p class="text-center">{{ __('Check your score') }}</p>
            <br>
            <h2 class="text-center">{{ $resolution->calculateScore() }}%</h2>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="{{ route('courses.view', ['id' => $resolution->activity->unit->course->id]) }}" class="btn btn-primary">{{ __('Back to Course') }}</a>
        </div>
    </div>

@endsection
