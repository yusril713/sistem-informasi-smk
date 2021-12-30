<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') | SMK PGRI 2 WONOGIRI</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('admin/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('ckeditor/plugins/simple-ruler/styles/ruler-styles.css') }}">
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="index.html">SMK PGRI 2 <br><p>WONOGIRI<p></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"   >
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">{{ Auth::user()->name }}</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="{{ route('account.index') }}">
                    <i class="mdi mdi-pen mr-2 text-success"></i> {{ Auth::user()->name }} </a>
                <a class="dropdown-item" href="{{ route('manage-password.index') }}">
                    <i class="mdi mdi-key mr-2 text-success"></i> Change Password </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img class="avatar" src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="mb-2">{{ Auth::user()->name }}</span>
                  <span class="text-secondary text-small">SMK PGRI 2</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            @role('Super Admin|Admin|Guru|Osis')
                @role('Super Admin|Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manage-ppdb.index') }}">
                    <span class="menu-title">PPDB {{ TahunAjaran::getTahun() ? TahunAjaran::getTahun() : '' }}</span>
                    <i class="mdi mdi-check-all menu-icon"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-orders" aria-expanded="false" aria-controls="ui-orders">
                    <span class="menu-title">Profil</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-format-list-bulleted  menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-orders">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-profil.index') }}">Profil</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-visimisi.index') }}">Visi dan Misi</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-sambutan.index') }}">Sambutan Kepala Sekolah</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-struktur-organisasi.index') }}">Struktur Organisasi</a></li>
                    </ul>
                    </div>
                </li>
                @endrole
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manage-galeri.index') }}">
                    <span class="menu-title">Galeri</span>
                    <i class="mdi mdi-film menu-icon"></i>
                    </a>
                </li>

                @role('Super Admin|Admin|Guru')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('manage-pengumuman.index') }}">
                    <span class="menu-title">Pengumuman</span>
                    <i class="mdi mdi-information menu-icon"></i>
                    </a>
                </li>
                @endrole

                @role('Super Admin|Admin')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-data-master" aria-expanded="false" aria-controls="ui-data-master">
                    <span class="menu-title">Akademik</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi mdi-account-check menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-data-master">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-tahun-ajaran.index') }}">Tahun Ajaran</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-jurusan.index') }}">Jurusan</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-kelas.index') }}">Kelas</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-guru.index') }}">Guru</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-siswa.index') }}">Siswa</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ route('registration-siswa.index') }}">Daftar Kelas Siswa</a></li>
                    </ul>
                    </div>
                </li>
                @endrole

                @role('Super Admin|Admin|Guru|Osis')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-info" aria-expanded="false" aria-controls="ui-info">
                    <span class="menu-title">Informasi</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-newspaper  menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-info">
                    <ul class="nav flex-column sub-menu">
                        @role('Super Admin|Admin')
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-kategori.index') }}">Kategori</a></li>
                        @endrole
                        @foreach (KategoriInformasi::get() as $item)
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-informasi.index', [$item->slug]) }}">{{ $item->kategori }}</a></li>
                        @endforeach
                    </ul>
                    </div>
                </li>
                @endrole

                @role('Super Admin|Admin|Guru')
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-file" aria-expanded="false" aria-controls="ui-file">
                    <span class="menu-title">File</span>
                    <i class="menu-arrow"></i>
                    <i class="mdi mdi-file  menu-icon"></i>
                    </a>
                    <div class="collapse" id="ui-file">
                    <ul class="nav flex-column sub-menu">
                        @role('Super Admin|Admin')
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-kategori-file.index') }}">Kategori</a></li>
                        @endrole
                        @foreach (KategoriFile::get() as $item)
                        <li class="nav-item"> <a class="nav-link" href="{{ route('manage-file.index', [$item->slug]) }}">{{ $item->kategori }}</a></li>
                        @endforeach
                    </ul>
                    </div>
                </li>
                @endrole
            @endrole

            @role('Super Admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
                  <span class="menu-title">Settings</span>
                  <i class="menu-arrow"></i>
                  <i class="mdi mdi mdi-settings menu-icon"></i>
                </a>
                <div class="collapse" id="ui-settings">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('manage-role.index') }}">Role</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('manage-permission.index') }}">Permission</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('assign-role.index') }}">Assign Role</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('assign-permission.index') }}">Assign Permission</a></li>
                  </ul>
                </div>
            </li>
            @endrole
          </ul>
        </nav>
        @yield('content')
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('admin/js/off-canvas.js') }}"></script>
    <script src="{{asset('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{asset('admin/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('admin/js/dashboard.js') }}"></script>
    <script src="{{asset('admin/js/todolist.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tb_produk').DataTable();
        } );
    </script>
    <script>
        $('#exampleInputFile').on('change',function(){
            //get the file name
            var fileName = $(this).val();
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName);
        })

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
    <script>
      var konten = document.getElementById("konten");
        CKEDITOR.replace(konten,{
        language:'en-gb'
      });
      CKEDITOR.config.allowedContent = true;


      CKEDITOR.on('instanceReady', function (ev) {
        ev.editor.dataProcessor.htmlFilter.addRules( {
            elements : {
                img: function( el ) {
                    // Add bootstrap "img-responsive" class to each inserted image
                    el.addClass('img-fluid');

                    // Remove inline "height" and "width" styles and
                    // replace them with their attribute counterparts.
                    // This ensures that the 'img-responsive' class works
                    var style = el.attributes.style;

                    if (style) {
                        // Get the width from the style.
                        var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec(style),
                            width = match && match[1];

                        // Get the height from the style.
                        match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec(style);
                        var height = match && match[1];

                        // Replace the width
                        if (width) {
                            el.attributes.style = el.attributes.style.replace(/(?:^|\s)width\s*:\s*(\d+)px;?/i, '');
                            el.attributes.width = width;
                        }

                        // Replace the height
                        if (height) {
                            el.attributes.style = el.attributes.style.replace(/(?:^|\s)height\s*:\s*(\d+)px;?/i, '');
                            el.attributes.height = height;
                        }
                    }

                    // Remove the style tag if it is empty
                    if (!el.attributes.style)
                        delete el.attributes.style;

                }
            }
        });
    });
    </script>
    <!-- End custom js for this page -->
    @yield('script')
  </body>
</html>
