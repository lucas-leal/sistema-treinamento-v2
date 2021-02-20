@extends('layout')

@section('main')
    <div class="starter-template">
        <h2 class="">All courses</h2>

        <div class="row">
            @foreach ($courses as $course)
                <div class="col-sm-12 col-md-4 col-lg-3 course-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="btn btn-primary">Subscribe</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
