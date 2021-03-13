@extends('layout')

@section('main')
    <div class="starter-template">
        <h2>{{ __('All courses') }}</h2>

        <div class="row">
            @foreach ($courses as $course)
                <div class="col-sm-12 col-md-4 col-lg-3 course-card">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text">{{ $course->description }}</p>
                            @auth('admin')
                                <a href="{{ route('courses.view', ['id' => $course->id]) }}" class="btn btn-primary">{{ __('Enter') }}</a>
                            @endauth
                            @guest('admin')
                                @if (Auth::user()->isRegisteredOnCourse($course))
                                    <a href="{{ route('courses.view', ['id' => $course->id]) }}" class="btn btn-primary">{{ __('Enter') }}</a>
                                @else
                                    <a href="{{ route('registration', ['id' => $course->id]) }}" class="btn btn-primary">{{ __('Subscribe') }}</a>
                                @endif
                            @endguest
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
