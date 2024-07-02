@extends('Admin.Master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Update Exam Information</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">student </li>
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
                                        <i class="fas fa-edit" style="font-size: 4rem;"></i> Edit Exam
                                    </h1>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('exam.update', $exam->id) }}">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">
                                        <label for="course_name" class="mt-3">Course Name:</label>
                                        <input type="text" name="course_name" value="{{ $exam->courseName }}"
                                            id="course_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="mt-3">Description:</label>
                                        <input type="text" name="description" value="{{ $exam->description }}"
                                            id="description" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="instruction" class="mt-3">Instruction:</label>
                                        <input type="text" name="instruction" value="{{ $exam->instruction }}"
                                            id="instruction" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="topic" class="mt-3">Topic:</label>
                                        <input type="text" name="topic" id="topic" value="{{ $exam->topic }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="date" class="mt-3">Date:</label>
                                        <input type="date" name="date" value="{{ $exam->date }}" id="date"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_time" class="mt-3">Start Time:</label>
                                        <input type="time" name="start_time" value="{{ $exam->startDate }}"
                                            id="start_time" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_time" class="mt-3">End Time:</label>
                                        <input type="time" value="{{ $exam->endDate }}" name="end_time" id="end_time"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="end_time" class="mt-3">Total Mark</label>
                                        <input type="text" name="total_mark" value="{{ $quize->total_mark }}"
                                            id="total_mark" class="form-control">
                                    </div>

                                    <button class="btn btn-warning" type="submit">update</button>

                                </form>
                                <hr>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h1 class="card-title">
                                        <i class="fas fa-edit" style="font-size: 4rem;"></i> Edit Questions
                                    </h1>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('question.update.multiple', $exam_id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    @foreach ($questions as $question)
                                        <div class="question-set mb-3">
                                            <input type="hidden" name="question_ids[]" value="{{ $question->id }}">

                                            <div class="form-group ml-3">
                                                <label for="question{{ $question->id }}" style="font-size: 2rem">Question
                                                    {{ $loop->iteration }}</label>
                                                <input type="text" name="questions[{{ $question->id }}][question]"
                                                    class="form-control"
                                                    value="{{ old('questions.' . $question->id . '.question', $question->question_text) }}"
                                                    required>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label>Options:</label>
                                                <div class="form-group ml-5">
                                                    <label for="answer_a{{ $question->id }}">A</label>
                                                    <input type="text" name="questions[{{ $question->id }}][answer_a]"
                                                        class="form-control"
                                                        value="{{ old('questions.' . $question->id . '.answer_a', $question->answer_a) }}"
                                                        required>
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="answer_b{{ $question->id }}">B</label>
                                                    <input type="text" name="questions[{{ $question->id }}][answer_b]"
                                                        class="form-control"
                                                        value="{{ old('questions.' . $question->id . '.answer_b', $question->answer_b) }}"
                                                        required>
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="answer_c{{ $question->id }}">C</label>
                                                    <input type="text" name="questions[{{ $question->id }}][answer_c]"
                                                        class="form-control"
                                                        value="{{ old('questions.' . $question->id . '.answer_c', $question->answer_c) }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label for="correct_answer{{ $question->id }}">Right Answer:</label>
                                                <select name="questions[{{ $question->id }}][correct_answer]"
                                                    class="form-control bg-primary" required>
                                                    <option value="Option A"
                                                        {{ $question->correct_answer === 'Option A' ? 'selected' : '' }}>
                                                        Option A</option>
                                                    <option value="Option B"
                                                        {{ $question->correct_answer === 'Option B' ? 'selected' : '' }}>
                                                        Option B</option>
                                                    <option value="Option C"
                                                        {{ $question->correct_answer === 'Option C' ? 'selected' : '' }}>
                                                        Option C</option>
                                                </select>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label for="mark{{ $question->id }}">Mark:</label>
                                                <input type="text" name="questions[{{ $question->id }}][mark]"
                                                    class="form-control"
                                                    value="{{ old('questions.' . $question->id . '.mark', $question->mark) }}"
                                                    required>
                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <div class="float-sm-right">
                                        <button type="" class="btn btn-warning">
                                            <a href="{{ route('exam.show') }}" style="color: red">Cancel</a>
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
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
