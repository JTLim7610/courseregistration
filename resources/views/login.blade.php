@extends("pages.admin.layout.empty")

@section('head')
<link href="/css/page/auth.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')

@include('component.blob')

<!--Loader section end -->
<div class='login row'>
    <div class="col-5 sign-in">
        <div class='login-section'>
            <div class='header'>
                <h3>Login</h3>
            </div>
            <div class='login-form'>
                {!! Form::open(['class'=>'loginbox', 'method'=>'post', 'url' => route('submit')]) !!}
                    <div class="loginbox loginpromptbox">
                        <div class="email" style="margin-top:30px;">
                            <label class="font-size:16px;font-weight:500;color: #223445;">Email Address</label>
                            <input name="email" class="form-control " type="text" placeholder="Please insert your email address" required />
                        </div>
                        <div class="password" style="margin-top:30px;margin-bottom:30px;">
                            <label class="font-size:16px;font-weight:500;color: #223445">Password</label>
                            <input name="password" class="form-control" type="password" placeholder="Please insert your password" required />
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        {!! NoCaptcha::renderJs('eng', false, 'onloadCallback') !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <div class="signinbtn">
                        <button type="submit" class="btn btn-submit btn-primary" data-sitekey="6LcSZv4cAAAAAHsBOHZbYIrskUQa48Eo4B_hvBxJ" 
                        data-callback='onSubmit' 
                        data-action='submit'>Login</button>                  
                    </div>
                {!! Form::close() !!}
                <div class="register row" style="text-align:center; margin-top:10px; position: absolute;left: 30%;">
                    <p style="font-size: 14px;">Doesn't have an account? </p>
                    <a style="font-size: 14px;margin-left:5px; color:blue; text-decoration:underline;" href="/register"> Register now</a>
                </div>
                <div class="row" style="text-align:center; margin-left:40%; margin-top:60px;">    
                    <a style="text-align:center; font-size: 14px;margin-left:5px; color:blue; text-decoration:underline;" href="/guest">Login As Guest</a> 
                </div>
            </div>
        </div>
        
    </div>
    <div class="col-7 background-img">
    </div>
</div>

<script>
    var onloadCallback = function() {
      alert("grecaptcha is ready!");
    };
</script>

@stop