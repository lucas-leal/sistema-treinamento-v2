@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">{{ __('New video') }}</h4>
            <form action="{{ route('videos.store', ['id' => $course->id]) }}" method="post" enctype="multipart/form-data">
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
                <div class="row">
                    <div class="form-group col-md-6">
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="file" required>
                            <label class="custom-file-label" for="file" id="file-label">{{ __('Choose file') }}...</label>
                            <div class="invalid-feedback">
                                @error('file')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            </form>
        </div>
    </div>
@endsection