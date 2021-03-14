@extends('layout')

@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <h3 class="d-inline">{{ __('User report') }}: <b>{{ $user->name }}</b></h3>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Course') }}</th>
                        <th>{{ __('Watched videos') }}</th>
                        <th>{{ __('Average activities score') }}</th>
                        <th>{{ __('Approved') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->registrations as $registration)
                        <tr>
                            <td>{{ $registration->course->title }}</td>
                            <td>{{ $user->countViewedVideosByCourse($registration->course) }}/{{ $registration->course->videos()->count() }}</td>
                            <td>{{ $registration->calculateScore() }} %</td>
                            <td>
                                @if ($registration->isConcluded())
                                    {{ __('Yes') }}
                                @else
                                    {{ __('No') }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
