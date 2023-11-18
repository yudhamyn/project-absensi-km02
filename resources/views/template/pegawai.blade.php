<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Meta -->
  <meta name="description" content="Aplikasi Presensi Premium By Abduloh Malela">
  <meta name="author" content="Abduloh Malela">
  <link rel="shortcut icon" href="{{ url('') }}/assets/template/presensi-abdul/img/logo.jpg">

  <!-- Title -->
  <title>{{ $judul_halaman }}</title>


  <!-- *************
			************ Common Css Files *************
		************ -->
  <!-- Bootstrap css -->
  <link rel="stylesheet" href="{{ url('') }}/assets/template/presensi-abdul/css/bootstrap.min.css">

  <!-- Icomoon Font Icons css -->
  <link rel="stylesheet" href="{{ url('') }}/assets/template/presensi-abdul/fonts/style.css">

  <!-- Main css -->
  <link rel="stylesheet" href="{{ url('') }}/assets/template/presensi-abdul/css/main.css">


  <!-- *************
			************ Vendor Css Files *************
		************ -->

  <!-- Required jQuery first, then Bootstrap Bundle JS -->
  <script src="{{ url('') }}/assets/template/presensi-abdul/js/jquery.min.js"></script>
  <script src="{{ url('') }}/assets/template/presensi-abdul/js/bootstrap.bundle.min.js"></script>
  <script src="{{ url('') }}/assets/template/presensi-abdul/js/modernizr.js"></script>
  <script src="{{ url('') }}/assets/template/presensi-abdul/js/moment.js"></script>
  <script src="{{ url('') }}/assets/template/presensi-abdul/vendor/swal/sweetalert2.all.js"></script>

  <!-- PLUGIN -->
  {!! $plugins !!}

</head>

<body>

  <!-- Loading wrapper start -->
  <div id="loading-wrapper">
    <div class="spinner-border"></div>
    Loading...
  </div>
  <!-- Loading wrapper end -->

  <!-- Page wrapper start -->
  <div class="page-wrapper">
    @yield('content')
  </div>
  <!-- Page wrapper end -->

  <!-- *************
			************ Required JavaScript Files *************
		************* -->
  <!-- *************
			************ Vendor Js Files *************
		************* -->

  <!-- Slimscroll JS -->
  <script src="{{ url('') }}/assets/template/presensi-abdul/vendor/slimscroll/slimscroll.min.js"></script>
  <script src="{{ url('') }}/assets/template/presensi-abdul/vendor/slimscroll/custom-scrollbar.js"></script>

  <!-- Main Js Required -->
  <script src="{{ url('') }}/assets/template/presensi-abdul/js/main.js"></script>

</body>

</html>