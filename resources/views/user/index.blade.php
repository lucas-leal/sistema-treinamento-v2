@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-8">
            <h4>Users</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Login</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->login }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
