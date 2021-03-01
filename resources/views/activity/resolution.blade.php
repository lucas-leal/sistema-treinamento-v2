@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <h4 class="mb-3">{{ $activity->title }}</h4>
            
            <form action="{{ route('resolution.store', ['id' => $activity->unit->course->id, 'activityId' => $activity->id]) }}" method="post">
                @csrf
                @foreach ($activity->questions as $question)
                    <div class="row">
                        <div class="col-md-12 font-weight-bold">{{ $question->description }}</div>
                    </div>
                    <br>
                    @foreach ($question->options as $option)
                        <div class="form-check">
                            <input class="form-check-input @error($question->id) is-invalid @enderror" type="radio" name="{{ $question->id }}" id="{{ $question->id }}" value="{{ $option->id }}">
                            <label class="form-check-label" for="{{ $question->id }}">
                                {{ $option->description }}
                            </label>
                        </div>
                    @endforeach
                    <br>
                @endforeach
                
                <button type="submit" class="btn btn-primary">Finalize</button>
            </form>
        </div>
    </div>

@endsection
