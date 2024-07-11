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
                        @if (auth::user()->role_id == 1)
                            <li class="nav-item ">
                                <a href="{{ url('index') }}"
                                    class="nav-link {{ request()->is('index') ? 'active' : '' }}">
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
                                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                    <p>Exam Board</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('exam.result') }}" class="nav-link">
                                    <i class="fas fa-diagnoses nav-icon"></i>
                                    <p>Exam Result</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('view.student') }}" class="nav-link">
                                    <i class="fas fa-user-graduate nav-icon"></i>
                                    <p>Student</p>
                                </a>
                            </li>
                        @endif
                        @if (auth::user()->role_id == 1 || auth::user()->role_id == 3)
                            <li class="nav-item ">
                                <a href="{{ url('group') }}"
                                    class="nav-link {{ Request::is('group') ? 'active' : '' }}">
                                    <i class="fas fa-object-group nav-icon"></i>
                                    Group</a>
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
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">


                                    <div class="table-responsive">
                                        <table id="studentScoresTable"
                                            class="table table-bordered table-striped table-hover">
                                            <thead>
                                                <tr class="bg-primary">
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Gender</th>
                                                    <th>Date of Birth</th>
                                                    <th>Exam Topic</th>
                                                    <th>Exam Name</th>
                                                    <th>Total Marks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $student)
                                                    <tr>
                                                        <td>{{ $student->student_id }}</td>
                                                        <td>{{ $student->stname }}</td>
                                                        <td>{{ $student->email }}</td>
                                                        <td>{{ $student->gender }}</td>
                                                        <td>{{ date('d-M-Y', strtotime($student->DateOfBirth)) }}</td>
                                                        <td>{{ $student->topic }}</td>
                                                        <td>{{ $student->courseName }}</td>
                                                        <td>{{ $student->total_marks }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ route('generate-pdf') }}" class="btn btn-primary flaot-right">Export
                                        to
                                        PDF</a>

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
    <script>
        $(document).ready(function() {
            var table = $('#studentScoresTable').DataTable();

            // Handle change event on exam name dropdown
            $('#examName').on('change', function() {
                var examName = $(this).val();

                // Filter table based on selected exam name
                if (examName) {
                    table.columns(6).search(examName).draw();
                } else {
                    table.search('').columns().search('').draw();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $('#studentScoresTable').DataTable();

            $('#exportPdfButton').on('click', function() {
                var doc = new jsPDF();
                doc.autoTable({
                    html: '#studentScoresTable',
                    styles: {
                        fillColor: [100, 255, 255]
                    },
                });
                doc.save('student_scores.pdf');
            });
        });
    </script>

</body>

</html>
