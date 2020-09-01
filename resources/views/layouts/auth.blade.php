<!DOCTYPE html>
<html lang="en">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.png')}}">

    <title>OTOBID Indonesia</title>

    <!-- vendor css -->
    <link href="{{asset('assets/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">

    <!-- template CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/template.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/template.auth.css')}}">
    <style type="text/css">
      .img-login {
        max-width: 750px;
        height: auto;
      }
    </style>
  </head>
  <body>
    <header class="navbar navbar-header navbar-header-fixed">
      <!-- <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a> -->
      <div class="navbar-brand">
        <a href="#" class="df-logo">OTOBID<span>Indonesia</span></a>
      </div><!-- navbar-brand -->
    </header><!-- navbar -->
    @yield('contents')

    @include('layouts.footer')
    <script type="text/javascript"> var baseUrl = "{{config('app.url')}}" </script>
    <script src="{{asset('assets/lib/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/lib/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>

    <script src="{{asset('assets/js/template.js')}}"></script>

    <!-- append theme customizer -->
    <script src="{{asset('assets/lib/js-cookie/js.cookie.js')}}"></script>
    <script src="{{asset('assets/js/main.settings.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>

  </body>
</html>
