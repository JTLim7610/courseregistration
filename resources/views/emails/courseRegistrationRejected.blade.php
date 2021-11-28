@component('mail::message')
# Your course registration was rejected.

<div>Hello <strong>{{ $user->name }}</strong>!</div>

<div>Your course registration for <strong>Course : {{ $course->name }}</strong> has rejected by admin.</div>
<div>Kindly apply for other courses.</div>
<div>Thank You for your support.</div>

@component('mail::button', ['url' => '/'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
