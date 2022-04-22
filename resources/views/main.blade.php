<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layout Default - Mazer Admin Dashboard</title>

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
  {{-- {{ dd(phpinfo()) }} --}}
  <div id="app">
    <div id="sidebar" class="active">
      <div class="sidebar-wrapper active">
        <div class="sidebar-header">
          <div class="d-flex justify-content-between">
            <div class="logo">
              <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
            </div>
            <div class="toggler">
              <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
          </div>
        </div>
        <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Menu</li>

            @if (auth()->user()->role_id == \App\Models\User::ROLE_ADMIN)
              <li class="sidebar-item  ">
                <a href="index.html" class='sidebar-link'>
                  <i class="bi bi-grid-fill"></i>
                  <span>Dashboard</span>
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
              <li class="sidebar-item @if(Route::currentRouteName() == 'pic.verification.index' || Request::is('pic/verification*')) active @endif">
                <a href="{{ route('pic.verification.index') }}" class='sidebar-link'>
                  <i class="bi bi-person-check-fill"></i>
                  <span>Pegawai</span>
                </a>
              </li>
            @endif

            @if (auth()->user()->role_id == \App\Models\User::ROLE_USER)
              <li class="sidebar-item  @if(Route::currentRouteName() == 'user.dashboard.index') active @endif">
                <a href="{{ route('user.dashboard.index') }}" class='sidebar-link'>
                  <i class="bi bi-grid-fill"></i>
                  <span>Dashboard</span>
                </a>
              </li>

              <li class="sidebar-item  @if(Route::currentRouteName() == 'user.profile.index' || Request::is('user/profile*')) active @endif">
                <a href="{{ route('user.profile.index') }}" class='sidebar-link'>
                  <i class="bi bi-person-badge"></i>
                  <span>Profile</span>
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
                  <span>Cetak QrCode</span>
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
              <h3>Layout Default</h3>
              <p class="text-subtitle text-muted">The default layout </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
              <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Layout Default</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        @yield('content')
      </div>

      <footer>
        <div class="footer clearfix mb-0 text-muted">
          <div class="float-start">
            <p>2021 &copy; Mazer</p>
          </div>
          <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                href="http://ahmadsaugi.com">A. Saugi</a></p>
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

</html>