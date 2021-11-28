
@component('mail::message')
# A user's course registration payment has done

<div>Hello <strong>Admin</strong>!</div>

<div>A new <strong>User : {{ $user->name }}</strong> has completed payment for <strong>Course : {{ $course->name }}</strong>.</div>
<div>Kindly proceed to approvement steps. </div>

@component('mail::button', ['url' => '/'])
UTAR Short Course
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
