<!DOCTYPE html>
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
          {{-- <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                href="http://ahmadsaugi.com">A. Saugi</a></p>
          </div> --}}
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