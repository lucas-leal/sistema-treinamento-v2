@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <h4 class="mb-3">New video</h4>
            <form action="{{ route('videos.store', ['id' => $course->id]) }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="url">Url</label>
                        <input type="text" name="url" id="url" value="{{ old('url') }}" class="form-control @error('url') is-invalid @enderror">
                        <div class="invalid-feedback">
                            @error('url')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="unit">Unit</label>
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
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection