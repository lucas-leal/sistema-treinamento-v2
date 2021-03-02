@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">{{ __('New course') }}</h4>
            <form action="/courses" method="post">
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

                    <div class="form-group col-md-6">
                        <label for="category">{{ __('Category') }}</label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                            <option value=""></option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            @error('category')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label for="description">{{ __('Description') }}</label>
                        <textarea id="description" name="description" rows="2" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        <div class="invalid-feedback">
                            @error('description')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="instructor">{{ __('Instructor') }}</label>
                        <input type="text" name="instructor" id="instructor" value="{{ old('instructor') }}" class="form-control @error('instructor') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('instructor')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="keywords">{{ __('Keywords') }}</label>
                        <input type="text" name="keywords" id="keywords" class="form-control @error('keywords') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('keywords')
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
