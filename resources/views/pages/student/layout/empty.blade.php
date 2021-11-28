<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="/img/logo/utar_logo.png" />
    <title>Utar World</title>

    <link href="/css/prod/component/index_preload.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <link href="/css/prod/admin/index.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="/js/prod/component/index_preload.js{{ config('app.link_version') }}"></script>
    <script defer type="text/javascript" src="/js/prod/admin/index.js{{ config('app.link_version') }}"></script>

    @yield('head')
    
</head>

<body id="emptyLayout">

    <!--Loader section -->
    @include('component.loader')

    <!-- Content section -->
    <div class="content">
        @yield('content')
    </div>

</body>

@include('script.index')

</html>
