<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="/img/logo/utar_logo.png" />

    <link href="/css/prod/component/index_preload.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <link href="/css/prod/admin/index.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="/js/prod/component/index_preload.js{{ config('app.link_version') }}"></script>
    <script defer type="text/javascript" src="/js/prod/admin/index.js{{ config('app.link_version') }}"></script>
    
    @yield('head')

</head>

<body>
    {{-- 181543 --}}
    <!--Loader section -->
    @include('component.loader')
    <nav class="navbar navbar-expand-lg" style="background-color: #181543" id="navbar">
      {{-- UTAR pic to return home  --}}
      {{-- if is guest --}}
      @if(!Auth::user())
        <a class="navbar-brand" href="/guest">
            <img style="width:150px; height: 80px;" src="https://upload.wikimedia.org/wikipedia/en/f/f1/Universiti_Tunku_Abdul_Rahman_Logo.jpg" />
        </a>
      {{-- if is student --}}
      @elseif(Auth::user())
        <a class="navbar-brand" href="/student/account">
            <img style="width:150px; height: 80px;" src="https://upload.wikimedia.org/wikipedia/en/f/f1/Universiti_Tunku_Abdul_Rahman_Logo.jpg" />
        </a>
      @endif
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        {{-- navigation bar  --}}
        <div  style="float: right;" class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto my-2 my-lg-0" >
            {{-- if is guest --}}
            @if(!Auth::user())
              <li class="nav-item active">
                <a  class="nav-link header-text" href="/guest">Course List <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a  class="nav-link header-text" href="/guest/about_us">About Us <span class="sr-only"></span></a>
              </li>
              <li class="nav-item" style="position: absolute; right:0;">
                <a class="nav-link header-text" href="/">Login / Register<span class="sr-only"></span></a>
              </li>
            {{-- if is student --}}
            @elseif(Auth::user())
              <li class="nav-item active">
                <a  class="nav-link header-text" href="/student/account">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle header-text" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Explore
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Event</a>
                  <a class="dropdown-item" href="#">Short Course</a>
                  <a class="dropdown-item" href="#">Short Programme</a>
                </div>
              </li>
              <li class="nav-item">
                  <a  class="nav-link header-text" href="/student/account/registered_course">My Registrations <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                  <a href="/student/account/payment"  class="nav-link header-text" href="#">My Payments <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a  class="nav-link header-text" href="/student/account/feedback">Contact Us<span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a  class="nav-link header-text" href="/student/account/about_us">About Us <span class="sr-only"></span></a>
              </li>
              <li class="nav-item" style="position: absolute; right:0;">
                <a class="nav-link header-text" href="/logout">Logout<span class="sr-only"></span></a>
              </li>
          @endif

        </div>
    </nav>
    
    <div class="content">
        @yield('content')
    </div>
</body>

{{-- @include('modal.action') --}}
@include('script.index')
</html>

