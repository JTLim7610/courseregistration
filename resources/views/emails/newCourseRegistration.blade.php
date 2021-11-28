
@component('mail::message')
# New Student registered a course

<div>Hello <strong>{{ $user->name }}</strong>!</div>
<div>
    Thank you for registering with <strong>Course:{{ $course->name }}</strong>. <br>
    Please verify your account before <strong>{{ $registeredCourse->activity_expire}}</strong>. <br> <br>
    Please Click on the button to verify your account.
</div>

@component('mail::button', ['url' => route('course.verify',[$registeredCourse->activity_token])])
Click to activate your course registration
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent