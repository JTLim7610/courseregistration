@component('mail::message')
# Account activation Email

<div>Hello <strong>{{ $user->name }}</strong>!</div>
<div>
    Thank you for registering with Utar short courses. <br>
    Please verify your account before <strong>{{ $user->activity_expire }}</strong>. <br> <br>
    Please Click on the button to verify your account.
</div>

@component('mail::button', ['url' => route('user.verify',[$user->activity_token])])
Click to activate your Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
