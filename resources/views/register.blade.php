@extends("pages.admin.layout.empty")

@section('head')
<link href="/css/page/auth.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')
<div class='login row'>
    <div class="col-6 sign-in">
        <div class='login-section'>
            <div class='header'>
                <h3>Registration</h3>
            </div>
            <div class='login-form'>
                {!! Form::open(['class'=>'loginbox', 'method'=>'post', 'url' => route('create')]) !!}
                <div class="loginbox loginpromptbox">
                    <div class="name" style="margin-top:30px;">
                        <label class="font-size:16px;font-weight:500;color: #223445;">Name</label>
                        <input name="name" class="form-control " type="text" placeholder="Please insert your name" required />
                    </div>
                    <div class="email" style="margin-top:30px;">
                        <label class="font-size:16px;font-weight:500;color: #223445;">Email Address</label>
                        <input name="email" class="form-control " type="text" placeholder="Please insert your email address" required />
                    </div>
                    <div class="email" style="margin-top:30px;">
                        <label class="font-size:16px;font-weight:500;color: #223445;">Password</label>
                        <input name="password" class="form-control " type="password" placeholder="Please insert your password" required />
                    </div>
                    <div class="email" style="margin-top:30px;">
                        <label class="font-size:16px;font-weight:500;color: #223445;">Confirm Password</label>
                        <input name="password_confirmation" class="form-control " type="password" placeholder="Please insert your password" required />
                    </div>
                    
                    <div class="form-group mt-4">
                        {!! NoCaptcha::renderJs('eng', false, 'onloadCallback') !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="signinbtn" style="margin-top:30px;">
                        <button type="submit" class="btn btn-submit btn-primary">Register Now</button>                  
                    </div>
                    <div class="login row" style="text-align:center; margin-top:10px; position: absolute;left: 30%;">
                        <p style="font-size: 14px;">Already have an account? </p>
                        <a style="font-size: 14px;margin-left:5px; color:blue; text-decoration:underline;" href="/index"> Login now</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-6 background-img">
    </div>
</div>
@stop