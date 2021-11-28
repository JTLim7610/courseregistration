
@component('mail::message')
# Your course registration was approved by admin!

<div>Hello <strong>{{ $user->name }}</strong>!</div>

<div>Your course registration for <strong>Course : {{ $course->name }}</strong> has approved by admin.</div>
<div>Kindly proceed to payment steps. </div>

@component('mail::button', ['url' => '/'])
UTAR Short Course
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
