<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Admin_Lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('Admin_Lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }} ">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('Admin_Lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('Admin_Lte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('Admin_Lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('Admin_Lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('Admin_Lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('Admin_Lte/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="icon" type="{{ asset('logo/cheu.png') }}" href="{{ asset('logo/logo.png') }}" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
    <style>
        @font-face {
            font-family: 'Kantumruy Pro';
            src: url('path/to/kantumruy-pro.woff2') format('woff2'),
                url('path/to/kantumruy-pro.woff') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Source Sans Pro', sans-serif;
            /* Fallback font */
        }

        /* Apply Kantumruy Pro to Khmer text */
        body,
        .nav-sidebar {
            /* Adjust as per your Khmer text usage */
            font-family: 'Kantumruy Pro', sans-serif;
        }

        .layout-fixed .main-sidebar {
            background-color: rgb(14, 13, 106);
            font-family: 'Kantumruy Pro', sans-serif;
            font-weight: bold;
        }

        .content .card-title {
            font-family: 'Kantumruy Pro', sans-serif;
            font-weight: bold;
        }

        .nav-sidebar {
            font-size: 1.2rem;
        }
    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('logo/logo.png') }}" alt="AdminLTELogo" height="200"
                width="200">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
                    @csrf
                    <button type="submit" class="btn btn-danger"​ style="font-weight:500;">ចាកចេញពីគណនី</button>
                </form>



            </ul>
        </nav>
        <!-- /.navbar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="" class="brand-link">
                <img src="{{ asset('logo/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Online Exam</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        @if (Auth::check() && Auth::user()->user_image)
                            <img src="{{ asset(Auth::user()->user_image) }}" class="img-circle elevation-2"
                                alt="User Image">
                        @else
                            <img src="{{ asset('logo/pretty_girl_smile.png') }}" class="img-circle elevation-2"
                                alt="User Image">
                        @endif
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            @if (Auth::check())
                                {{ Auth::user()->name }}
                            @else
                                Guest
                            @endif
                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                                                                                                                                                                                                       with font-awesome or any other icon font library -->
                        @if (auth::user()->role_id == 1)
                            <li class="nav-item ">
                                <a href="{{ url('index') }}"
                                    class="nav-link {{ request()->is('index') ? 'active' : '' }}
                                ">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    {{-- Dashboard --}}
                                    ផ្ទាំងព៍ត៌មាន
                                </a>
                            </li>
                        @endif

                        @if (auth::user()->role_id == 1)
                            <li class="nav-item ">
                                <a href="{{ url('teacher') }}"
                                    class="nav-link {{ Request::is('teacher') ? 'active' : '' }}">
                                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                                    គ្រូ</a>
                            </li>
                        @endif

                        {{-- <a href="{{ url('home1/cheu') }}"
                            class="nav-item nav-link {{ Request::is('home1/cheu') ? 'active' : '' }}">Home</a> --}}

                        @if (auth::user()->role_id == 1 || auth::user()->role_id == 3)
                            <li class="nav-item">
                                <a href="{{ route('exam.show') }}" class="nav-link">
                                    {{-- <i class="far fa-plus-square nav-icon"></i> --}}
                                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                    {{-- <p>Exam Board</p> --}}
                                    <p>វិញ្ញាសាប្រលង</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('exam.result') }}" class="nav-link">
                                    <i class="fas fa-diagnoses nav-icon"></i>
                                    {{-- <p>Exam Result</p> --}}
                                    <p>លទ្ទផលប្រលង</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('view.student') }}" class="nav-link">
                                    <i class="fas fa-user-graduate nav-icon"></i>
                                    {{-- <p>Student</p> --}}
                                    <p>អំពីសិស្ស</p>
                                </a>
                            </li>
                        @endif
                        @if (auth::user()->role_id == 1 || auth::user()->role_id == 3)
                            <li class="nav-item ">
                                <a href="{{ url('group') }}"
                                    class="nav-link {{ Request::is('group') ? 'active' : '' }}">
                                    <i class="fas fa-object-group nav-icon"></i>
                                    ក្រុម</a>
                            </li>
                        @endif





                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Main Sidebar Container -->
        @yield('content')
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>ចម្លង និងរក្សាសិទ្ទដោយ &copy; 2023-2024 <a href="https://adminlte.io">OnlineExam.com</a>.</strong>
            {{-- All rights reserved. --}}
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('Admin_Lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Admin_Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Admin_Lte/dist/js/adminlte.min.js') }}"></script>
    <script>
        document.getElementById('exampleInputFile').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>



    {{-- <!-- jQuery -->
    <script src="{{ asset('Admin_Lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('Admin_Lte/plugins/jquery-ui/jquery-ui.min.js ') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Admin_Lte/plugins/bootstrap/js/bootstrap.bundle.min.js ') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('Admin_Lte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('Admin_Lte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('Admin_Lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('Admin_Lte/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('Admin_Lte/plugins/jquery-knob/jquery.knob.min.js ') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('Admin_Lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('Admin_Lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('Admin_Lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('Admin_Lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('Admin_Lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Admin_Lte/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('Admin_Lte/dist/js/demo.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('Admin_Lte/dist/js/pages/dashboard.js') }}"></script> --}}
    <style>
        .layout-fixed .main-sidebar {
            background-color: rgb(14, 13, 106);
            font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
            font-weight: bold;
        }

        .nav-sidebar {
            font-size: 1.2rem;
        }
    </style>
</body>

</html>
