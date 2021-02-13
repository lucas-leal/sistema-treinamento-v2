@extends('layout')

@section('main')
    <h1>Course viewing</h1>
    {{ $course->id }}

    <h4>Units</h4>
    @foreach ($course->units as $unit)
        {{ $unit->name }} <br>
    @endforeach
@endsection
