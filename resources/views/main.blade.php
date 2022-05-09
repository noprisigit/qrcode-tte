<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>SITTE - @yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet" />

    @yield('css')
  </head>

  <body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
      <!-- Sidebar -->
      <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
          <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">SITTE</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0" />

        @if (auth()->user()->role_id == \App\Models\User::ROLE_ADMIN)
          <li class="nav-item @if (Route::currentRouteName() == 'admin.dashboard.index') active @endif">
            <a class="nav-link" href="{{ route('admin.dashboard.index') }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
          </li>

          <li class="nav-item @if(Route::currentRouteName() == 'admin.verifikasi-pegawai.index' || Route::currentRouteName() == 'admin.verifikasi-pegawai.verify' || Route::currentRouteName() == 'admin.verifikasi-pegawai.detail') active @endif">
            <a class="nav-link" href="{{ route('admin.verifikasi-pegawai.index') }}">
              <i class="fas fa-fw fa-user-check"></i>
              <span>Verifikasi Pegawai</span>
            </a>
          </li>

          <li class="nav-item @if(Route::currentRouteName() == 'admin.dinas.index' || Route::currentRouteName() == 'admin.bidang.index' || Request::is('admin.user.index')) active @endif">
            <a class="nav-link @if(Route::currentRouteName() <> 'admin.dinas.index' || Route::currentRouteName() <> 'admin.bidang.index' || Route::currentRouteName() <> 'admin.user.index') collapsed @endif" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="@if(Route::currentRouteName() == 'admin.dinas.index' || Route::currentRouteName() == 'admin.bidang.index') true @else false @endif" aria-controls="collapsePages">
              <i class="fas fa-fw fa-cogs"></i>
              <span>Master Data</span>
            </a>
            <div id="collapsePages" class="collapse @if(Route::currentRouteName() == 'admin.dinas.index' || Route::currentRouteName() == 'admin.bidang.index' || Request::is('administrator/users*')) show @endif" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item @if(Request::is('administrator/users*')) active @endif" href="{{ route('admin.user.index') }}">{{ __('Pengguna') }}</a>
                <a class="collapse-item @if(Route::currentRouteName() == 'admin.dinas.index') active @endif" href="{{ route('admin.dinas.index') }}">{{ __('Dinas') }}</a>
                <a class="collapse-item @if(Route::currentRouteName() == 'admin.bidang.index') active @endif" href="{{ route('admin.bidang.index') }}">{{ __('Sub Bidang') }}</a>
              </div>
            </div>
          </li>
        @endif

        @if (auth()->user()->role_id == \App\Models\User::ROLE_PIC)
          <li class="nav-item @if (Route::currentRouteName() == 'pic.dashboard.index') active @endif">
            <a class="nav-link" href="{{ route('pic.dashboard.index') }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="nav-item @if(Request::is('pic/pegawai/verification*')) active @endif">
            <a class="nav-link" href="{{ route('pic.verifikasi-pegawai.index') }}">
              <i class="fas fa-fw fa-user-check"></i>
              <span>Verifikasi Pegawai</span>
            </a>
          </li>

          <li class="nav-item @if(Route::currentRouteName() == 'pic.profile.index' || Request::is('pic/profile*')) active @endif">
            <a class="nav-link" href="{{ route('pic.profile.index') }}">
              <i class="fas fa-fw fa-user"></i>
              <span>Profil</span>
            </a>
          </li>

          <li class="nav-item @if(Route::currentRouteName() == 'pic.documents.index') active @endif">
            <a class="nav-link" href="{{ route('pic.documents.index') }}">
              <i class="fas fa-fw fa-folder"></i>
              <span>Berkas</span>
            </a>
          </li>

          <li class="nav-item @if(Route::currentRouteName() == 'pic.generate-qrcode.index') active @endif">
            <a class="nav-link" href="{{ route('pic.generate-qrcode.index') }}">
              <i class="fas fa-fw fa-qrcode"></i>
              <span>Cetak TTE</span>
            </a>
          </li>

        @endif

        @if (auth()->user()->role_id == \App\Models\User::ROLE_USER)
          <li class="nav-item @if (Route::currentRouteName() == 'user.profile.index' || Route::currentRouteName() == 'user.profile.change-password' || Route::currentRouteName() == 'user.profile.edit') active @endif">
            <a class="nav-link" href="{{ route('user.profile.index') }}">
              <i class="fas fa-fw fa-user"></i>
              <span>Profil</span>
            </a>
          </li>
          
          <li class="nav-item @if (Route::currentRouteName() == 'user.documents.index') active @endif">
            <a class="nav-link" href="{{ route('user.documents.index') }}">
              <i class="fas fa-fw fa-folder"></i>
              <span>Berkas</span>
            </a>
          </li>

          <li class="nav-item @if (Route::currentRouteName() == 'user.generate-qrcode.index') active @endif">
            <a class="nav-link" href="{{ route('user.generate-qrcode.index') }}">
              <i class="fas fa-fw fa-qrcode"></i>
              <span>Cetak TTE</span>
            </a>
          </li>

        @endif

        <!-- Nav Item - Dashboard -->
        

        <!-- Nav Item - Pages Collapse Menu -->
        

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block" />

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
      </ul>
      <!-- End of Sidebar -->

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
          <!-- Topbar -->
          <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
              <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

              <div class="topbar-divider d-none d-sm-block"></div>

              <!-- Nav Item - User Information -->
              <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ auth()->user()->nama }}</span>
                  <img class="img-profile rounded-circle" src="{{ asset('assets/img/undraw_profile.svg') }}" />
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  {{-- <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profile
                  </a> --}}
                  {{-- <div class="dropdown-divider"></div> --}}
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    {{ __('Keluar') }}
                  </a>
                </div>
              </li>
            </ul>
          </nav>
          <!-- End of Topbar -->

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">@yield('title')</h1>

            @yield('content')
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright &copy; Provinsi Kepulauan Bangka Belitung {{ date('Y') }}</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
      </div>
      <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Yakin untuk keluar?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih "Keluar" dibawah ini jika yakin untuk keluar.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <a class="btn btn-primary" href="{{ route('logout') }}">Keluar</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <script src="{{ asset('assets/js/custom.js') }}"></script>

    @stack('js')
  </body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') - SITTE</title>

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

  @yield('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

  <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
</head>

<body>
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header">
          <div class="d-flex justify-content-center">
            <a href="#"><img src="{{ asset('assets/images/logo/logo_babel.png') }}" height="100%" alt="Logo" srcset=""></a>
            <div class="toggler">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Menu</li>

            @if (auth()->user()->role_id == \App\Models\User::ROLE_ADMIN)
              <li class="sidebar-item  @if (Route::currentRouteName() == 'admin.dashboard.index') active @endif">
                <a href="{{ route('admin.dashboard.index') }}" class='sidebar-link'>
                  <i class="bi bi-grid-fill"></i>
                  <span>Dashboard</span>
                </a>
              </li>

              <li class="sidebar-item @if(Route::currentRouteName() == 'admin.pegawai.index' || Route::currentRouteName() == 'admin.pegawai.verification' || Route::currentRouteName() == 'admin.pegawai.detail') active @endif">
                <a href="{{ route('admin.pegawai.index') }}" class='sidebar-link'>
                  <i class="bi bi-person-check-fill"></i>
                  <span>Pegawai</span>
                </a>
              </li>

              <li class="sidebar-item @if(Route::currentRouteName() == 'admin.dinas.index' || Route::currentRouteName() == 'admin.bidang.index') active @endif has-sub">
                <a href="#" class='sidebar-link'>
                  <i class="bi bi-stack"></i>
                  <span>{{ __('Master Data') }}</span>
                </a>
                <ul class="submenu @if(Route::currentRouteName() == 'admin.dinas.index' || Route::currentRouteName() == 'admin.bidang.index') active @endif">
                  <li class="submenu-item @if(Route::currentRouteName() == 'admin.dinas.index') active @endif">
                    <a href="{{ route('admin.dinas.index') }}">{{ __('Dinas') }}</a>
                  </li>
                  <li class="submenu-item @if(Route::currentRouteName() == 'admin.bidang.index') active @endif">
                    <a href="{{ route('admin.bidang.index') }}">{{ __('Sub Bidang') }}</a>
                  </li>
                </ul>
              </li>
            @endif

            @if (auth()->user()->role_id == \App\Models\User::ROLE_PIC)
              <li class="sidebar-item @if(Route::currentRouteName() == 'pic.verification.index' || Route::currentRouteName() == 'pic.verification.edit' || Route::currentRouteName() == 'pic.verification.detail') active @endif">
                <a href="{{ route('pic.verification.index') }}" class='sidebar-link'>
                  <i class="bi bi-person-check-fill"></i>
                  <span>Pegawai</span>
                </a>
              </li>

              <li class="sidebar-item  @if(Route::currentRouteName() == 'pic.profile.index' || Request::is('pic/profile*')) active @endif">
                <a href="{{ route('pic.profile.index') }}" class='sidebar-link'>
                  <i class="bi bi-person-badge"></i>
                  <span>Profil</span>
                </a>
              </li>
              
              <li class="sidebar-item  @if(Route::currentRouteName() == 'pic.documents.index') active @endif">
                <a href="{{ route('pic.documents.index') }}" class='sidebar-link'>
                  <i class="bi bi-file-check"></i>
                  <span>Berkas</span>
                </a>
              </li>

              <li class="sidebar-item  @if(Route::currentRouteName() == 'pic.verification.profile') active @endif">
                <a href="{{ route('pic.verification.profile') }}" class='sidebar-link'>
                  <i class="bi bi-card-checklist"></i>
                  <span>Verifikasi</span>
                </a>
              </li>

              <li class="sidebar-item  @if(Route::currentRouteName() == 'pic.generate-qrcode.index') active @endif">
                <a href="{{ route('pic.generate-qrcode.index') }}" class='sidebar-link'>
                  <i class="bi bi-code-square"></i>
                  <span>Cetak TTE</span>
                </a>
              </li>
            @endif

            @if (auth()->user()->role_id == \App\Models\User::ROLE_USER)
      
              <li class="sidebar-item  @if(Route::currentRouteName() == 'user.profile.index' || Request::is('user/profile*')) active @endif">
                <a href="{{ route('user.profile.index') }}" class='sidebar-link'>
                  <i class="bi bi-person-badge"></i>
                  <span>Profil</span>
                </a>
              </li>
              
              <li class="sidebar-item  @if(Route::currentRouteName() == 'user.documents.index') active @endif">
                <a href="{{ route('user.documents.index') }}" class='sidebar-link'>
                  <i class="bi bi-file-check"></i>
                  <span>Berkas</span>
                </a>
              </li>

              <li class="sidebar-item  @if(Route::currentRouteName() == 'user.verification.index') active @endif">
                <a href="{{ route('user.verification.index') }}" class='sidebar-link'>
                  <i class="bi bi-card-checklist"></i>
                  <span>Verifikasi</span>
                </a>
              </li>

              <li class="sidebar-item  @if(Route::currentRouteName() == 'user.generate-qrcode.index') active @endif">
                <a href="{{ route('user.generate-qrcode.index') }}" class='sidebar-link'>
                  <i class="bi bi-code-square"></i>
                  <span>Cetak TTE</span>
                </a>
              </li>
            @endif

            <li class="sidebar-item  ">
              <a href="{{ route('auth.logout') }}" class='sidebar-link'>
                <i class="bi bi-power"></i>
                <span>Keluar</span>
              </a>
            </li>

          </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
    </div>
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>

      <div class="page-heading">
        <div class="page-title">
          <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
              <h3>@yield('title')</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    @if(auth()->user()->role_id == \App\Models\User::ROLE_USER)
                      <a href="{{ route('user.profile.index') }}">Home</a>
                    @endif

                    @if(auth()->user()->role_id == \App\Models\User::ROLE_ADMIN)
                      <a href="{{ route('admin.dashboard.index') }}">Home</a>
                    @endif
                    
                    @if(auth()->user()->role_id == \App\Models\User::ROLE_PIC)
                      <a href="{{ route('pic.verification.index') }}">Home</a>
                    @endif
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

      </div>
      <div class="page-content">
        @yield('content')
      </div>

      <footer>
        <div class="footer clearfix mb-0 text-muted">
          <div class="float-start">
            <p>{{ date('Y') }} &copy; Provinsi Kepulauan Bangka Belitung</p>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  
  @stack('js')
  
  <script src="{{ asset('assets/js/mazer.js') }}"></script>
</body>

</html> --}}