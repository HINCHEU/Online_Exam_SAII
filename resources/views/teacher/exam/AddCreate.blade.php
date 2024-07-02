@extends('Admin.Master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Exam</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">student</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h1 class="card-title">
                                        <i class="fas fa-envelope-open-text" style="font-size: 3rem">Create Exam</i>
                                    </h1>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('exam.save', Auth::user()->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="course_name" class="mt-3">Course Name:</label>
                                        <input type="text" name="course_name" id="course_name" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="mt-3">Descriptions:</label>
                                        <input type="text" name="description" id="description" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="instruction" class="mt-3">Instructions:</label>
                                        <input type="text" name="instruction" id="instruction" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="topic" class="mt-3">Topic:</label>
                                        <input type="text" name="topic" id="topic" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date" class="mt-3">Date:</label>
                                        <input type="date" name="date" id="date" class="form-control"
                                            min="{{ now()->toDateString() }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="start_time" class="mt-3">Start Time:</label>
                                        <input type="time" name="start_time" id="start_time" class="form-control"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="end_time" class="mt-3">End Time:</label>
                                        <input type="time" name="end_time" id="end_time" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="total_mark" class="mt-3">Total Mark:</label>
                                        <input type="text" name="total_mark" id="total_mark" class="form-control"
                                            required>
                                    </div>

                                    <button class="btn btn-primary" type="submit">Submit</button>
                                </form>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <!-- /.container-fluid -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </section>
        <!-- /.content -->
    </div>

    <!-- Script to set minimum date and time dynamically -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var now = new Date();
            var year = now.getFullYear();
            var month = ('0' + (now.getMonth() + 1)).slice(-2);
            var day = ('0' + now.getDate()).slice(-2);
            var hours = ('0' + now.getHours()).slice(-2);
            var minutes = ('0' + now.getMinutes()).slice(-2);

            var currentDate = year + '-' + month + '-' + day;
            var currentTime = hours + ':' + minutes;

            document.getElementById('date').min = currentDate;
            document.getElementById('start_time').min = currentTime;
            document.getElementById('end_time').min = currentTime;

            // Additional validation for time inputs
            document.getElementById('start_time').addEventListener('input', function() {
                validateTimeInputs();
            });

            document.getElementById('end_time').addEventListener('input', function() {
                validateTimeInputs();
            });

            function validateTimeInputs() {
                var startDate = document.getElementById('date').value + 'T' + document.getElementById('start_time')
                    .value;
                var endDate = document.getElementById('date').value + 'T' + document.getElementById('end_time')
                    .value;

                // Ensure end time is not before start time
                if (startDate && endDate && new Date(endDate) <= new Date(startDate)) {
                    document.getElementById('end_time').setCustomValidity('End time must be after start time');
                } else {
                    document.getElementById('end_time').setCustomValidity('');
                }
            }
        });
    </script>
@endsection
