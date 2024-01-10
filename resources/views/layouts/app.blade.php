<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | SmartLedger</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
	  <style>
        .error {
			color: red !important;
		}
    </style>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    @livewireStyles
    @include('layouts.partials.css')
    @yield('css')
</head>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">


@include('layouts.partials.navbar')
  <!-- Left side column. contains the logo and sidebar -->

  @include('layouts.partials.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section>
        @yield('content.header')
    </section>

    <!-- Main content -->
    <section class="content">

    @yield('content')
 
    </section>

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
