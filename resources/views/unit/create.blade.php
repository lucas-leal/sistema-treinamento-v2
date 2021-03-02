@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">{{ __('New unit') }}</h4>
            <form action="{{ route('units.store', ['id' => $course->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="title">{{ __('Title') }}</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('title')
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
