@extends('layout')

@section('main')
    <h1>Courses listing</h1>
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
@endsection
