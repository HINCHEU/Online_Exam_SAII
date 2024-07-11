<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Scores</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('Admin_Lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('Admin_Lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
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

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"
        integrity="sha384-0evSX huddled7lwJEuBfRn5qIBFyJpBv/adjxXvNWfD9qmZQ81w/HqONaLtqaytT9t4zYjEMzqzSODQi456YvBmYb85aOeXauz+z0T4+/zAp+Dw"
        crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- Custom CSS for layout -->
    <style>
        html,
        body {
            height: 100%;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex: 1;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            /* Adjust as per your design */
            padding: 10px 20px;
        }

        .card {
            width: 80%;
            /* Adjust width as needed */
            margin: 0 auto;
            /* Center horizontally */
            margin-top: 20px;
            /* Adjust spacing from top */
        }

        .dataTables_wrapper .dataTables_filter {
            float: none;
            text-align: right;
            border-color: red;
        }

        .layout-fixed .main-sidebar {
            background-color: rgb(14, 13, 106);
            font-family: Calibri, Candara, Segoe, "Segoe UI", Optima, Arial, sans-serif;
            font-weight: bold;
        }

        .nav-sidebar {
            font-size: 1.2rem;
        }

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

        .nav-sidebar {
            font-size: 1.2rem;
        }

        /* Custom CSS for responsive table */
        @media (max-width: 800px) {
            .table thead {
                display: none;
            }

            .table tr {
                display: block;
                margin-bottom: 0.625rem;
            }

            .table td {
                display: block;
                text-align: right;
                font-size: 0.875rem;
                border-bottom: 1px solid #dee2e6;
                position: relative;
                padding-left: 20%;
            }

            .table td::before {
                content: attr(data-label);
                position: absolute;
                left: 0;
                width: 50%;
                padding-left: 0.75rem;
                font-weight: 600;
                text-align: left;
                white-space: nowrap;
            }
        }
    </style>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

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
                <!-- Navbar Search -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="">
                    @csrf
                    <button type="submit" class="btn btn-danger">Log out</button>
                </form>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
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
                            <img src="{{ asset('logo/cheu.png') }}" class="img-circle elevation-2" alt="User Image">
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
                                    Dashboard</a>
                            </li>
                        @endif

                        @if (auth::user()->role_id == 1)
                            <li class="nav-item ">
                                <a href="{{ url('teacher') }}"
                                    class="nav-link {{ Request::is('teacher') ? 'active' : '' }}">
                                    <i class="fas fa-chalkboard-teacher mr-2"></i>
                                    Teacher</a>
                            </li>
                        @endif


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
        <!-- /.main-sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Student Scores</h1>
                        </div>
                        <div class="col-sm-6">
                            <!-- Exam Name Dropdown -->
                            <div class="float-right">
                                <label for="examName">Select Exam Name:</label>
                                <select id="examName" class="form-control">
                                    <option value="">All Exams</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->courseName }}">{{ $student->courseName }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="studentScoresTable"
                                            class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th style="width: 3%;">លេខ</th>
                                                    <th style="width: 20%;">ឈ្មោះ</th>
                                                    <th style="width: 10%;">អ៊ីម៉ែលសិស្ស</th>
                                                    <th style="width: 4%;">ភេទ</th>
                                                    <th style="width: 10%;">ក្រុម</th>
                                                    <th style="width: 30%;">ថ្ងៃ ខែ កំណើត</th>
                                                    <th style="width: 15%;">ប្រធានប្រលង</th>
                                                    <th style="width: 20%;">ឈ្មោះប្រលង</th>
                                                    <th style="width: 5%;">ពិន្ទុ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $student)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $student->stname }}</td>
                                                        <td>{{ $student->email }}</td>
                                                        <td>{{ $student->gender }}</td>
                                                        <td>{{ $student->group_name }}</td>
                                                        <td>
                                                            {{ date('d-M-Y', strtotime($student->DateOfBirth)) }}</td>
                                                        <td>{{ $student->topic }}</td>
                                                        <td>{{ $student->courseName }}</td>
                                                        <td>{{ $student->correct_score }}/{{ $student->total_possible_score }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container -->
            </div>
            <!-- /.content -->


        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="footer">
            <div class="container">
                <p class="float-left">&copy; 2023-2024 <a href="https://adminlte.io">OnlineExam.com</a>. All rights
                    reserved.</p>
                <p class="float-right">Version 3.2.0</p>
            </div>
        </footer>
        <!-- /.footer -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('Admin_Lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('Admin_Lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('Admin_Lte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Buttons -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <!-- DataTables Khmer Language File -->
    <script src="https://cdn.datatables.net/plug-ins/1.13.1/i18n/Khmer.json"></script>


    <script>
        $(document).ready(function() {
            var table = $('#studentScoresTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]

            });


            // Handle change event on exam name dropdown
            $('#examName').on('change', function() {
                var examName = $(this).val();

                // Filter table based on selected exam name
                if (examName) {
                    table.columns(7).search(examName).draw();
                } else {
                    table.search('').columns().search('').draw();
                }
            });



        });
    </script>


</body>

</html>
