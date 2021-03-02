@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">{{ __('Evaluate course') }}</h4>
            <form action="{{ route('evaluations.store', ['id' => $course->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="score">{{ __('Score') }}</label>
                        <select name="score" id="score" class="form-control @error('score') is-invalid @enderror">
                            <option value=""></option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" @if (old('score') == $i) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>
                        <div class="invalid-feedback">
                            @error('score')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="comment">{{ __('Comment') }}</label>
                        <input type="text" name="comment" id="comment" value="{{ old('comment') }}" class="form-control @error('comment') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('comment')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
        </div>
    </div>

@endsection
