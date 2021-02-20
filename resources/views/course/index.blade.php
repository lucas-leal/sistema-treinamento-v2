@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <h3 class="d-inline">Courses</h3>
                <a href="/courses/create" class="btn btn-primary float-right">New</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Instructor</th>
                        <th>Keywords</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->category->name }}</td>
                            <td>{{ $course->instructor }}</td>
                            <td>{{ $course->keywords }}</td>
                            <td><a href="{{ route('courses.view', ['id' => $course->id]) }}">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
