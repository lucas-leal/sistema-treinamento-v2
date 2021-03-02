@extends('layout')

@section('main')
    <?php use App\Models\Activity; ?>
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">{{ __('Questions') }}</h4>
            <form action="{{ route('activities.store', ['id' => $course->id]) }}" method="post">
                @csrf
                <input type="hidden" name="title" value="{{ $title }}">
                <input type="hidden" name="unit" value="{{ $unit->id }}">
                <input type="hidden" name="questions" value="{{ $questions }}">

                @for ($question = 1; $question <= $questions; $question++)
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="question-{{$question}}">{{ __('Question') }} {{ $question }}</label>
                            <textarea id="question-{{$question}}" name="question-{{$question}}" rows="2" class="form-control @error('question-'.$question) is-invalid @enderror">{{ old('question-'.$question) }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        @for ($option = 1; $option <= Activity::NUMBER_OPTIONS; $option++)
                            <div class="form-group col-md-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="correct-option-{{$question}}" id="correct-option-{{$question}}" value="option-{{$question}}-{{$option}}">
                                </div>
                            </div>
                            <div class="form-group col-md-11">
                                <label for="option-{{$question}}-{{$option}}">{{ __('Option') }} {{ $option }}</label>
                                <input type="text" name="option-{{$question}}-{{$option}}" id="option-{{$question}}-{{$option}}" value="{{ old('option-'.$question.'-'.$option) }}" class="form-control @error('option-'.$question.'-'.$option) is-invalid @enderror">
                            </div>
                        @endfor
                    </div>
                    <br>
                @endfor
                <button type="submit" class="btn btn-primary">{{ __('Finalize') }}</button>
            </form>
        </div>
    </div>

@endsection
