@extends("pages.admin.layout.empty")

@section('head')
<link href="/css/page/auth.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
@endsection

@section('content')

<div class="landing-col col-xs-11 sign-in">
        <div class="" style="display: flex; justify-content: center; align-items: center; height: 100vh">
            <div class="card text-center">        
                <div class="card-header" >
                Account Activation
                </div>
                <div class="card-body">
                    @if($res === false)
                        <div>
                            <p class="card-text">
                                Your activation link has been expired ! <br>       
                                Please re-register for a account. <br><br>
                            </p>
                            <a href="/register" class="btn btn-primary">Register Page</a>
                        </div>
                    @else
                        <p class="card-text">
                            Congratulations! Your account is now active. <br>       
                            Please login to start your courses. <br><br>
                        </p>
                        <a href="/" class="btn btn-primary">Login Page</a>
                    @endif
                </div>
            </div>
        </div>

</div>
@endsection





