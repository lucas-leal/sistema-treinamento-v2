@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-6">
            <h3>{{ $course->title }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Instructor</h5>
                    <p class="card-text">{{ $course->instructor }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <ul class="list-group">
                <li class="list-group-item h4">units</li>
                @foreach ($course->units as $unit)
                    <li class="list-group-item">{{ $unit->name }}</li>
                @endforeach
                <li class="list-group-item h4">
                    <input type="text" name="" id="" class="form-control">
                    <button class="btn btn-primary">Save</button>
                </li>
            </ul>
        </div>
    </div>
@endsection
