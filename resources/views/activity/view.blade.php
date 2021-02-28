@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">{{ $activity->title }}</h4>
            
            @foreach ($activity->questions as $question)
                <div class="row">
                    <div class="col-md-12 font-weight-bold">{{ $question->description }}</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <ul>
                            @foreach ($question->options as $option)
                                <li class="@if ($option->correct) text-success @endif">{{ $option->description }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
