<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="app-url" content="{{env('APP_URL')}}" />
    <meta name="robots" content="index,follow" />
    <meta name="author" content="Cloudsite, support@cloudsite.com.my">
    <link rel="shortcut icon" href="/img/logo/utar_logo.png" />
    <title>Course Registration Dashboard</title>

    <link href="/css/prod/component/index_preload.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <link href="/css/prod/admin/index.css{{ config('app.link_version') }}" type="text/css" rel="stylesheet"/>
    <script type="text/javascript" src="/js/prod/component/index_preload.js{{ config('app.link_version') }}"></script>
    <script defer type="text/javascript" src="/js/prod/admin/index.js{{ config('app.link_version') }}"></script>
    @yield('head')

</head>

<body>

    <!--Loader section -->
    @include('component.loader')

    <!-- Nav & Content -->
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="ti ti-menu-alt"></i>
                    <i class="ti ti-close close-nav"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div id='main-menu'>
                <div class='logo-section'>
                    <img src='/img/logo/utar_logo.png'/>
                </div>
                <ul class="list-unstyled components mb-5">
                    <li>
                        <a href='/admin/account'>
                            <i class="menu-icon ti-home">
                                <div>
                                    <span>Dashboard</span>
                                </div>
                            </i>
                        </a>
                    </li>
                   
                    @include('pages.admin.layout.menu.'.getUserRoleName())
                    <li>
                        <a href='/logout'>
                            <i class="menu-icon ti-share-alt">
                                <div>
                                    <span>Logout</span>
                                </div>
                            </i>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="layoutContent" class="">
            @yield('content')
        </div>
    </div>
</body>

{{-- @include('modal.action') --}}
@include('script.index')


</html>