<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | ToloSoft</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @livewireStyles
    @include('layouts.partials.css')
    @yield('css')
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div id="wrapper">
        @include('layouts.partials.navbar')
        <!--  BEGIN SIDEBAR  -->
        @include('layouts.partials.sidebar')
        <div class="content-wrapper" id="container">
            <section class="content-header">
                @yield('content.header')
            </section>
            <!-- Main content -->
            <section id="content" class="content">
                @yield('content')
            </section>
            <!--  END CONTENT AREA  -->
        </div>
        </div>
            <!-- END MAIN CONTAINER -->

        @include('layouts.partials.aside')
        <div class="control-sidebar-bg"></div>
    </div>
    @include('layouts.partials.script')
    @include('layouts.partials.footer')
    @livewireScripts
    <script>
        $(document).ajaxStart(function() {
            Pace.restart();
        });
    </script>
    @yield('script')
</body>

</html>
