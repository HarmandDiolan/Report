<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>

    <!-- Simple-DataTables CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <!-- Local CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <!-- Font Awesome JS -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        /* highlight active sidebar item */
        .sb-sidenav .nav-link.active {
            background-color: #4e73df;
            color: white !important;
        }
        .sb-sidenav .nav-link.active .sb-nav-link-icon i {
            color: white !important;
        }
    </style>
</head>
<body class="sb-nav-fixed">

    <!-- Top Navigation -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="{{ route('dashboard') }}">{{ config('app.name', 'OJT Report') }}</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <div class="ms-auto"></div>
        <ul class="navbar-nav me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    @auth
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Sidebar Layout -->
    <div id="layoutSidenav">
        <!-- Sidebar -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Report</div>
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link {{ request()->routeIs('schools.*') ? 'active' : '' }}" href="{{ route('schools.index') }}">
                            <div class="sb-nav-link-icon"><i class="fas fa-school"></i></div>
                            School List
                        </a>
                        <a class="nav-link {{ request()->routeIs('offices.*') ? 'active' : '' }}" href="{{ route('offices.index') }}">
                            <div class="sb-nav-link-icon"><i class="fa fa-building-o" aria-hidden="true"></i>
                            </div>
                            Office List
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()?->name ?? 'Guest' }}
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div id="layoutSidenav_content">
            <main class="p-4">
                {{-- page title (optional) --}}
                @if(View::hasSection('pageTitle'))
                    <div class="mb-4">
                        <h1 class="h3 text-gray-800">@yield('pageTitle')</h1>
                    </div>
                @endif

                {{-- flash messages --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Simple-DataTables JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

    <!-- Local JS -->
    <script src="{{ asset('js/scripts.js') }}"></script>

    <!-- Page-specific scripts -->
     <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    @yield('scripts')

</body>
</html>