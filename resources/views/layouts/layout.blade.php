<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">

    <title>OTOBID Indonesia - @yield('title')</title>

    <!-- vendor css -->
    <link href="{{asset('assets/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/template.css')}}">
    <!-- Additional CSS -->
    @yield('css')

  </head>
  <body class="page-profile">

    @include('layouts.header')

    <div class="content content-fixed">
      @yield('content')
    </div><!-- content -->

    @include('layouts.footer')
    <script src="{{asset('assets/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{asset('assets/js/template.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- append theme customizer -->
    <script src="{{asset('assets/lib/js-cookie/js.cookie.js')}}"></script>
    <!-- <script src="{{asset('assets/js/main.settings.js')}}"></script> -->

    @yield('js')
    
  </body>
</html>
