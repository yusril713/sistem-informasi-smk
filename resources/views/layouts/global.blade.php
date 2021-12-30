<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('users/assets/img/logo.png') }}" rel="icon">
  <link href="{{ asset('users/assets/img/logo.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('users/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('users/assets/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
  <link href="{{ asset('users/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('users/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('users/assets/vendor/owl.carousel/users/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ asset('users/assets/vendor/animate.css') }}/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('users/assets/vendor/aos/aos.css') }}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('users/assets/css/style.css') }}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Mentor - v2.2.1
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.html"></a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="{{ asset('users/assets/img/logo.png') }}" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
            <li class="{{ Request::is('/') ? 'active' : ''}}"><a href="{{ url('/') }}">Home</a></li>
            <li class="{{ Request::is('profil') ? 'active' : ''}}"><a href="{{ route('profil') }}">Profil</a></li>
            <li class="{{ Request::is('download') ? 'active' : ''}}"><a href="{{ route('download') }}">Download</a></li>
            <li class="{{ Request::is('struktur-organisasi') ? 'active' : ''}}"><a href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a></li>
            <li class="drop-down {{ (Request::is('direktori-guru') or  Request::is('direktori-siswa') or Request::is('direktori-alumni')) ? 'active' : ''}}"><a href="#">Direktori</a>
                <ul>
                    <li><a href="{{ route('direktori-guru') }}">Direktori Guru</a></li>
                    <li><a href="{{ route('direktori-siswa') }}">Direktori Siswa</a></li>
                    <li><a href="{{ route('direktori-alumni') }}">Direktori Alumni</a></li>
                </ul>
            </li>
            <li class="drop-down"><a href="#">Informasi</a>
                <ul>
                    @foreach (KategoriInformasi::get()->where('slug', '!=', 'ppdb') as $item)
                        <li class=""><a href="{{ route('informasi', [$item->slug]) }}">{{ $item->kategori }}</a></li>
                    @endforeach
                </ul>
            </li>

            <li class="drop-down {{ (Request::is('informasi') or Request::is('formulir-pendaftaran')) }}"><a href="#">PPDB {{ TahunAjaran::getTahun() }}</a>
                <ul>
                    <li><a href="{{ route('informasi', ['ppdb']) }}">Persyaratan</a></li>
                    <li><a href="{{ route('formulir-pendaftaran.index') }}">Formulir Pendaftaran</a></li>
                </ul>
            </li>

            <li class="drop-down {{ (Request::is('photos') or Request::is('videos')) ? 'active' : '' }}"><a href="#">Galeri</a>
                <ul>
                    <li><a href="{{ route('photos.index') }}">Foto</a></li>
                    <li><a href="{{ route('videos.index') }}">Video</a></li>
                </ul>
            </li>

            <li class="{{ Request::is('kontak') ? 'active' : ''}}"><a href="{{ route('kontak.index') }}">Kontak</a></li>

        </ul>
      </nav><!-- .nav-menu -->

        <a href="{{ route('login') }}" class="get-started-btn">
            @php
            if(Auth::check())
                $splitName = explode(' ', Auth::user()->name, 2);
            @endphp
            {{ Auth::check() ? 'Dashboard: ' . $splitName[0] : 'Login' }}
        </a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  @yield('carousel')
  @yield('toast')
  <main id="main">

    @yield('content')

  </main><!-- End #main -->
  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-4 footer-contact">
            <h3>SMK PGRI 2</h3>
            <p>
                Jl. Brigjen Katamso Kaliancar <br>
                Selogiri Wonogiri, <br>
              Jawa Tengah <br><br>
              <strong>Phone:</strong> (0273) 322736<br>
              <strong>Email:</strong> smkpgri2wonogiri@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-4 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ url('/') }}">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Profil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Download</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('struktur-organisasi') }}">Struktur Organisasi</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">PPDB {{ TahunAjaran::getTahun() }}</a></li>
            </ul>
          </div>

          <div class="col-lg-4 footer-newsletter">
            <h4>Google Maps</h4>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15811.823039757324!2d110.9068111!3d-7.794509!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xef1045a18325ea44!2sSMK%20PGRI%202%20Wonogiri!5e0!3m2!1sen!2s!4v1612213336972!5m2!1sen!2s" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>SMKS PGRI 2 Wonogiri</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/ -->
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="https://www.facebook.com/SMK-PGRI-2-WONOGIRI-STM-PHANTER--203106379722364/" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="https://www.instagram.com/panterwonogiri/?hl=bn" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('users/assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('users/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('users/assets/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('users/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('users/assets/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
  <script src="{{ asset('users/assets/vendor/counterup/counterup.min.js') }}"></script>
  <script src="{{ asset('users/assets/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('users/assets/vendor/aos/aos.js') }}"></script>
  <script type='text/javascript'>
    var e_mailit_config = {"display_counter":false,"after_share_dialog":false,"mobile_bar":false,"hover_pinit":true,"popup":true,"display_ads":false,"open_on":"onmouseover","emailit_branding":false,"notrack":false,"global_back_color":"#365899","mobile_back_color":"#2800FF","thanks_message":"Grazie per la condivisione!","follow_services":{},"mobile_position":"top","mobileServices":"Facebook,Twitter,WhatsApp,Viber,SMS,Email,Gmail,Outlook,Yahoo_Mail,AOL_Mail,MailRu,Telegram,WeChat,WordPress,Messenger,Skype,Kik,QQ,Line,Kakao","headline":{}};
    (function() {var b=document.createElement('script');b.type='text/javascript';b.async=true;b.src='//e-mailit.com/widget/menu3x/js/button.js';var c=document.getElementsByTagName('head')[0];c.appendChild(b) })()
    </script>

  <!-- Template Main JS File -->
  <script src="{{ asset('users/assets/js/main.js') }}"></script>
  <script>
      $(document).ready(function(){
        $('.toast').toast('show');
        });
  </script>
    @yield('script')
</body>

</html>
