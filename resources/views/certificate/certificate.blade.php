<h1>{{ __('Certificate') }}</h1>
<br><br><br><br><br>
<p>
    {{ __('We certify that') }}
    <b>{{ $certificate->registration->user->name }}</b>
    {{ __('completed the course')}}
    <b>{{ $certificate->registration->course->title }}</b>
</p>
<br><br><br><br><br>
<p>
    {{ $certificate->created_at }} - ID: {{ $certificate->id }}
</p>

<style>
    h1, p {
        text-align: center;
    }

    p {
        font-size: 18px;
    }
</style>