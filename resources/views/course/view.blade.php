@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <h3 class="d-inline">{{ $course->title }}</h3>
                <div class="btn-group float-right">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Create
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ url()->current() }}/units/create">Unit</a>
                        <a class="dropdown-item" href="{{ url()->current() }}/videos/create">Video</a>
                        <a class="dropdown-item" href="{{ url()->current() }}/files/create">File</a>
                        <a class="dropdown-item" href="{{ url()->current() }}/activities/create">Activity</a>
                    </div>
                </div>
            </div>
            <p>{{ $course->description }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <small>Category</small>
                    <h5>{{ $course->category->name }}</h5>

                    <small>Instructor</small>
                    <h5>{{ $course->instructor }}</h5>

                    <small>Keywords</small>
                    <h5>{{ $course->keywords }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <ul class="list-group">
                <li class="list-group-item h4">Units</li>
            </ul>

            <div id="accordion">
                @foreach ($course->units as $unit)
                    <div class="card">
                        <div class="card-header" id="heading{{ $unit->id }}">
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{ $unit->id }}" aria-expanded="false" aria-controls="collapse{{ $unit->id }}">
                                {{ $unit->title }}
                            </button>
                        </h5>
                        </div>

                        <div id="collapse{{ $unit->id }}" class="collapse" aria-labelledby="heading{{ $unit->id }}" data-parent="#accordion">
                            <div class="card-body">
                                @if ($unit->videos()->exists())
                                    <h5>Videos</h5>
                                    <ul>
                                        @foreach ($unit->videos as $video)
                                            <li>
                                                <a href="{{ $video->url }}">{{ $video->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                                @if ($unit->files()->exists())
                                    <h5>Files</h5>
                                    <ul>
                                        @foreach ($unit->files as $file)
                                            <li>
                                                <a href="{{ route('files.get', ['id' => $course->id, 'fileId' => $file->id]) }}">{{ $file->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @if ($unit->activities()->exists())
                                    <h5>Activities</h5>
                                    <ul>
                                        @foreach ($unit->activities as $activity)
                                            <li>
                                                <a href="{{ route('activities.view', ['id' => $course->id, 'activityId' => $activity->id]) }}">{{ $activity->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
