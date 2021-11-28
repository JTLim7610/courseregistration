@extends("pages.admin.layout.empty")

@section('head')
<link href="/css/page/auth.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')

<div class="landing-col col-xs-11 sign-in">
        <div class="" style="display: flex; justify-content: center; align-items: center; height: 100vh">
            <div class="card text-center">        
                <div class="card-header" >
                Check your inbox
                </div>
                <div class="card-body">
                    <p class="card-text">We have sent a email to your email . <br>       
                        Please click on the URL attached in the email to verify your account. <br><br>
                        ※ The validity period of the URL is 24 hours.
                    </p>
                    <a href="/" class="btn btn-primary">Back to Login Page</a>
                </div> 
            </div>
        </div>

</div>
@endsection




