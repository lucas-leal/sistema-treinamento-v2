@extends('layout')

@section('main')
<form action="{{ route('units.store', ['id' => $course->id]) }}" method="post">
        @csrf
        <h3>Register unit</h3>
        <div class="form-row col-md-8">
            <div class="form-group col-md-6">
                <label for="name">Title</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                <div class="invalid-feedback">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
@endsection
