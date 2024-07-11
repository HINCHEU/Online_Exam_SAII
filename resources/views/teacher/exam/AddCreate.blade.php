@extends('Admin.Master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">ការប្រលង</h1>
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
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h1 class="card-title">
                                        <i class="fas fa-envelope-open-text" style="font-size: 3rem">
                                            <span style="font-family: 'Kantumruy Pro', sans-serif;font-weight: bold;">
                                                បង្កើតការប្រលង
                                            </span>
                                        </i>
                                    </h1>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('exam.save', Auth::user()->id) }}" method="POST">
                                    @csrf
                                    @method('POST')

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="course_name" class="mt-3">ឈ្មោះមុខវិជ្ជា:</label>
                                                <input type="text" name="course_name" id="course_name"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="mt-3">លម្អិតអំពីប្រលង:</label>
                                                <input type="text" name="description" id="description"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="instruction" class="mt-3">ការណែនាំ:</label>
                                                <input type="text" name="instruction" id="instruction"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="topic" class="mt-3">ប្រធាន:</label>
                                                <input type="text" name="topic" id="topic" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date" class="mt-3">កាលបរិច្ឆេទ:</label>
                                                <input type="date" name="date" id="date" class="form-control"
                                                    min="{{ now()->toDateString() }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="start_time" class="mt-3">ម៉ោងចាប់ផ្ដើម:</label>
                                                <input type="time" name="start_time" id="start_time" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="end_time" class="mt-3">ម៉ោងបញ្ចប់:</label>
                                                <input type="time" name="end_time" id="end_time" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="total_mark" class="mt-3">ពិន្ទុសរុប:</label>
                                                <input type="number" name="total_mark" id="total_mark" class="form-control"
                                                    min="1" required>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">ដាក់ស្នើរ</button>
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

            var dateInput = document.getElementById('date');
            var startTimeInput = document.getElementById('start_time');
            var endTimeInput = document.getElementById('end_time');

            dateInput.min = currentDate;

            function updateStartTimeLimit() {
                if (dateInput.value === currentDate) {
                    startTimeInput.min = currentTime;
                } else {
                    startTimeInput.min = '';
                }
                validateTimeInputs();
            }

            dateInput.addEventListener('change', updateStartTimeLimit);
            startTimeInput.addEventListener('input', validateTimeInputs);
            endTimeInput.addEventListener('input', validateTimeInputs);

            function validateTimeInputs() {
                var startDate = dateInput.value + 'T' + startTimeInput.value;
                var endDate = dateInput.value + 'T' + endTimeInput.value;

                // Ensure end time is not before start time
                if (startDate && endDate && new Date(endDate) <= new Date(startDate)) {
                    endTimeInput.setCustomValidity('End time must be after start time');
                } else {
                    endTimeInput.setCustomValidity('');
                }
            }

            // Initialize validation on page load
            updateStartTimeLimit();
        });
    </script>
@endsection
