<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik App - @yield('title', 'Dashboard')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link nav-link">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Klinik App</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        @if(auth()->user()->role === 'dokter')
                            <li class="nav-item">
                                <a href="{{ route('dokter.dashboard') }}"
                                    class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dokter.jadwal-periksa.index') }}"
                                    class="nav-link {{ request()->routeIs('dokter.jadwal-periksa.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-calendar-alt"></i>
                                    <p>Jadwal Periksa</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dokter.memeriksa') }}"
                                    class="nav-link {{ request()->routeIs('dokter.memeriksa') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-stethoscope"></i>
                                    <p>Periksa Pasien</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dokter.obat') }}"
                                    class="nav-link {{ request()->routeIs('dokter.obat') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-pills"></i>
                                    <p>Kelola Obat</p>
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.dashboard') }}"
                                    class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.pasien.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.pasien.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Kelola Pasien</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.dokter.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.dokter.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-user-md"></i>
                                    <p>Kelola Dokter</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.poli.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.poli.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-hospital"></i>
                                    <p>Kelola Poli</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.obat.index') }}"
                                    class="nav-link {{ request()->routeIs('admin.obat.*') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-pills"></i>
                                    <p>Kelola Obat</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('header', 'Dashboard')</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 1.0.0
            </div>
            <strong>Copyright &copy; {{ date('Y') }} Klinik App.</strong> All rights reserved.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    @stack('scripts')
</body>

</html>