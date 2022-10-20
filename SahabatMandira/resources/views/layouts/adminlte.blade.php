<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    @yield('style')
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    {{-- datatables --}}
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    {{-- cropperjs --}}
    <link href="{{ asset('js/cropper/cropper.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-50BBRYS4HY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-50BBRYS4HY');

    </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @if (auth()->check())
        @if (auth()->user()->role->nama_role == 'peserta')
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @elseif (auth()->user()->role->nama_role == 'superadmin')
            <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
                @else
                <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
                    @endif
                    @endif
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                                    class="fas fa-bars"></i></a>
                        </li>
                    </ul>


                    <!-- Right navbar links -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <div class="dropdown">
                                @if (auth()->user()->role->nama_role == 'superadmin')
                                <button class="btn dropdown-toggle btn-dark" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    {{Auth::user()->username}}
                                </button>
                                @else
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-expanded="false">
                                    {{Auth::user()->username}}
                                </button>
                                @endif
                                <div class="dropdown-menu">
                                    @if(Auth::user()->role->nama_role == 'mentor')
                                    <a href="{{ route('User.halamanku',Auth::user()->email) }}" class="dropdown-item">
                                        <p>
                                            Halamanku
                                        </p>
                                    </a>
                                    @endif
                                    @can('peserta-permission')
                                    <a href="{{ route('User.show',Auth::user()->email) }}" class="dropdown-item">
                                        Akun
                                    </a>
                                    <a class="dropdown-item" href="{{ route('lamaran.lamaranku') }}"
                                        type="button">Kegiatan Ku</a>
                                    @endcan
                                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <p>
                                            Logout
                                        </p>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>

                        </li>
                    </ul>
                </nav>
                <!-- /.navbar -->

                <!-- Main Sidebar Container -->
                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <!-- Brand Logo -->
                    <a href="{{ route('dashboard') }}" class="brand-link">
                        <img src="{{ asset('landingpage/assets/img/logos/sahabatmandira.png') }}"
                            alt="SahabatMandira Logo" class="brand-image" style="opacity: .8">
                        <span class="brand-text font-weight-light">Rumah Mandira</span>
                    </a>

                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Sidebar user panel (optional) -->
                        <!-- Sidebar Menu -->
                        <nav class="mt-2">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                                data-accordion="false">
                                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                                <li class="nav-item has-treeview">
                                    @can('adminperusahaan-permission')
                                    @if (Auth::user()->perusahaans_id_admin !=null)
                                    <a href="{{ route('perusahaan.profile') }}"
                                        class="nav-link {{ Request::is('profile/perusahaan') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            Profile Perusahaan
                                        </p>
                                    </a>
                                    @endif
                                    @else
                                    <a href="{{ route('dashboard') }}"
                                        class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            Dashboard
                                        </p>
                                    </a>
                                    @endcan
                                </li>
                                @can('adminperusahaan-permission')
                                @if (Auth::user()->perusahaans_id_admin !=null)
                                <li class="nav-item has-treeview">
                                    <a href="{{ route('lowongan.index') }}"
                                        class="nav-link {{ Request::is('menu/lowongan') ? 'active' : '' }}">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            List Lowongan
                                        </p>
                                    </a>
                                </li>
                                @endif
                                @endcan
                                @can('adminblk-permission')
                                @if (auth()->user()->role->nama_role == 'superadmin')
                                <li class="nav-item">
                                    <a href="{{ route('User.daftar') }}" class="nav-link ">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Daftar Akun
                                        </p>
                                    </a>
                                </li>
                                @else
                                <li class="nav-item">
                                    <a href="{{ route('User.daftar') }}" class="nav-link ">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Daftar Peserta
                                        </p>
                                    </a>
                                </li>
                                @endif
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Pelatihan
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('sesiPelatihan.daftarPelatihan') }}" class="nav-link ">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Penugasan Admin
                                                </p>
                                            </a>
                                        </li>
                                        <li class="nav-item treeview">
                                            <a href="{{ route('sesiPelatihan.index') }}" class="nav-link">
                                                <i class="nav-icon far fa-circle"></i>
                                                <p>
                                                    Pengelolaan Sesi
                                                </p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                @if(Auth::user()->role->nama_role == 'peserta')
                                <li class="nav-item treeview">
                                    <a href="{{ route('sesiPelatihan.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Pelatihan
                                        </p>
                                    </a>
                                </li>
                                @endif
                                @if(Auth::user()->role->nama_role == 'peserta')
                                <li class="nav-item has-treeview">
                                    <a href="{{ route('listKerja.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Bursa Kerja
                                        </p>
                                    </a>
                                </li>
                                @endif
                                {{-- Admin BLK --}}
                                @can('adminblk-permission')
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Administrasi BLK
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('paketProgram.index') }}" class="nav-link ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Paket Program Pelatihan</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                {{-- Super Admin --}}
                                @can('super.admin-permission')
                                <li class="nav-item has-treeview {{ Request::is('menu/*') ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Master Management
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('blk.index') }}"
                                                class="nav-link {{ Request::routeIs('blk.*') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>BLK</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('kejuruans.index') }}"
                                                class="nav-link {{ Request::routeIs('kejuruans.*') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Kejuruan</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('subkejuruan.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>SubKejuruan</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview {{ Request::is('datapegawai/*') ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Data Pegawai
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('super.adminblk') }}"
                                                class="nav-link {{ Request::routeIs('super.adminblk*') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Admin BLK</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#"
                                                class="nav-link {{ Request::routeIs('kejuruans.*') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Admin Bursa</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('User.index') }}" class="nav-link">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Daftar User</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Mentor
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('keahlian.index') }}" class="nav-link ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Daftar Keahlian</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('User.mentoring') }}" class="nav-link ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Daftar Mentor</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('mandiraMentoring.index') }}" class="nav-link ">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>Validasi Program</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                @endcan
                                <li class="nav-item has-treeview">
                                    <a href="{{url('https://sahabatmandira.id/bantuan')}}" class="nav-link">
                                        <i class="nav-icon fas fa-copy"></i>
                                        <p>
                                            Bantuan
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                    <!-- /.sidebar -->
                </aside>

                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                @yield('page-bar')
                            </div><!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content-header -->

                    <!-- Main content -->
                    <section class="content">
                        @yield('contents')
                    </section>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
                <footer class="main-footer">
                    <strong>Copyright &copy; <a href="http://adminlte.io">Sahabat Mandira</a>.</strong>
                    All rights reserved.
                    {{-- <div class="float-right d-none d-sm-inline-block">
                        <b>Version</b> 3.0.4
                    </div> --}}
                </footer>

                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)

    </script>
    <!-- DataTables -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('adminlte/plugins/chart.js/Chart.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('adminlte/plugins/sparklines/sparkline.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('adminlte/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('adminlte/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js')}}"></script>
    <script src="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('adminlte/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    {{-- Cropper JS --}}
    <script src="{{ asset('js/cropper/cropper.min.js') }}"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    @yield('javascript')
</body>

</html>
