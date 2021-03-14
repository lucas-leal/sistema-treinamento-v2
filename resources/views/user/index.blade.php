@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <h3 class="d-inline">{{ __('Users') }}</h3>
                <a href="/users/create" class="btn btn-primary float-right">{{ __('New') }}</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Id') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Login') }}</th>
                        <th>{{ __('Report') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->login }}</td>
                        <td>
                            <a href="{{ route('user.report', ['id' => $user->id]) }}">{{ __('Report') }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
