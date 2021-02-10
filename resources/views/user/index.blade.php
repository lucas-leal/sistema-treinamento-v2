@extends('layout')

@section('main')
    <h1>Users</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Login</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->login }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
