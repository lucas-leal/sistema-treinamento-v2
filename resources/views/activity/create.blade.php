@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">{{ __('New activity') }}</h4>
            <form action="{{ route('activities.next', ['id' => $course->id]) }}" method="get">
                @csrf
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="questions">{{ __('Number of questions') }}</label>
                        <input type="number" name="questions" id="questions" value="{{ old('questions') }}" class="form-control @error('questions') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('questions')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="unit">{{ __('Unit') }}</label>
                        <select name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($course->units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->title }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('unit')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Next') }}</button>
            </form>
        </div>
    </div>

@endsection
