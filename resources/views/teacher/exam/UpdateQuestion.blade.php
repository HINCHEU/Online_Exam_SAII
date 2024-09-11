@extends('Admin.Master')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">កែសម្រួលព័ត៌មានការប្រលង</h1>
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
                                        <i class="fas fa-edit" style="font-size: 3rem;">
                                            <span style="font-family: 'Kantumruy Pro', sans-serif;font-weight: bold;">
                                                កែសម្រួលប្រលង
                                            </span>
                                        </i>
                                    </h1>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="{{ route('exam.update', $exam->id) }}" id="examForm">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">
                                        <label for="course_name" class="mt-3">មុខវជ្ជា:</label>
                                        <input type="text" name="course_name" value="{{ $exam->courseName }}"
                                            id="course_name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description" class="mt-3">អំពីប្រលង:</label>
                                        <input type="text" name="description" value="{{ $exam->description }}"
                                            id="description" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="instruction" class="mt-3">ការណែរនាំ:</label>
                                        <input type="text" name="instruction" value="{{ $exam->instruction }}"
                                            id="instruction" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="topic" class="mt-3">ប្រធាន:</label>
                                        <input type="text" name="topic" id="topic" value="{{ $exam->topic }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="date" class="mt-3">កាលបរិច្ឆេទ:</label>
                                        <input type="date" name="date" value="{{ $exam->date }}" id="date"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_time" class="mt-3">ម៉ោងចាប់ផ្ដើប:</label>
                                        <input type="time" name="start_time" value="{{ $exam->startDate }}"
                                            id="start_time" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_time" class="mt-3">ម៉ោងបញ្ជប់:</label>
                                        <input type="time" value="{{ $exam->endDate }}" name="end_time" id="end_time"
                                            class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="total_mark" class="mt-3">ពិន្ទុសរុប</label>
                                        <input type="text" name="total_mark" value="{{ $quize->total_mark }}"
                                            id="total_mark" class="form-control">
                                    </div>

                                    <button class="btn btn-warning" type="submit">Update</button>

                                </form>
                                <hr>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h1 class="card-title">
                                        <i class="fas fa-edit" style="font-size: 2.5rem;">
                                            <span style="font-family: 'Kantumruy Pro', sans-serif;font-weight: bold;">
                                                កែប្រែពិន្ទុ
                                            </span>
                                        </i>

                                    </h1>
                                    <h3>ពិន្ទុរសរុប: <span id="total-question-marks">0</span>/{{ $quize->total_mark }}</h3>
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

                                <form action="{{ route('question.update.multiple', $exam_id) }}" method="POST"
                                    id="questionsForm">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" name="quiz_total_mark" value="{{ $quize->total_mark }}">

                                    @foreach ($questions as $question)
                                        <div class="question-set mb-3">
                                            <input type="hidden" name="question_ids[]" value="{{ $question->id }}">

                                            <div class="form-group ml-3">
                                                <label for="question{{ $question->id }}" style="font-size: 2rem">សំណូរ
                                                    {{ $loop->iteration }}</label>
                                                <input type="text" name="questions[{{ $question->id }}][question]"
                                                    class="form-control"
                                                    value="{{ old('questions.' . $question->id . '.question', $question->question_text) }}"
                                                    required>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label>ជម្រើស:</label>
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
                                                        ជម្រើស A</option>
                                                    <option value="Option B"
                                                        {{ $question->correct_answer === 'Option B' ? 'selected' : '' }}>
                                                        ជម្រើស B</option>
                                                    <option value="Option C"
                                                        {{ $question->correct_answer === 'Option C' ? 'selected' : '' }}>
                                                        ជម្រើស C</option>
                                                </select>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label for="mark{{ $question->id }}">ពិន្ទុ:</label>
                                                <input type="text" name="questions[{{ $question->id }}][mark]"
                                                    class="form-control question-mark"
                                                    value="{{ old('questions.' . $question->id . '.mark', $question->mark) }}"
                                                    required data-question-total-mark="{{ $question->mark }}">
                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="submit" class="btn btn-primary">រក្សាទុកកាផ្លាល់ប្ដូរ</button>
                                    <div class="float-sm-right">
                                        <button type="button" class="btn btn-warning">
                                            <a href="{{ route('exam.show') }}" style="color: red">បោះបង់</a>
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

            // Additional validation for time inputs
            document.getElementById('date').addEventListener('input', validateTimeInputs);
            document.getElementById('start_time').addEventListener('input', validateTimeInputs);
            document.getElementById('end_time').addEventListener('input', validateTimeInputs);

            function validateTimeInputs() {
                var selectedDate = document.getElementById('date').value;
                var startTime = document.getElementById('start_time').value;
                var endTime = document.getElementById('end_time').value;

                var now = new Date();
                var startDateTime = new Date(selectedDate + 'T' + startTime);
                var endDateTime = new Date(selectedDate + 'T' + endTime);
                var nowDateTime = new Date();

                // Ensure start time is not in the past if the selected date is today
                if (selectedDate === currentDate && startDateTime < nowDateTime) {
                    document.getElementById('start_time').setCustomValidity(
                        'Start time must be in the future for today');
                } else {
                    document.getElementById('start_time').setCustomValidity('');
                }

                // Ensure end time is not before start time
                if (startTime && endTime && endDateTime <= startDateTime) {
                    document.getElementById('end_time').setCustomValidity('End time must be after start time');
                } else {
                    document.getElementById('end_time').setCustomValidity('');
                }
            }

            // Form submission handling for the "Save Changes" button
            document.querySelector('.btn-primary').addEventListener('click', function(event) {
                if (!validateTotalMarks()) {
                    event.preventDefault();
                }
            });

            // Update total question marks on input change
            document.querySelectorAll('.question-mark').forEach(function(markInput) {
                markInput.addEventListener('input', updateTotalQuestionMarks);
            });

            function updateTotalQuestionMarks() {
                var totalQuestionMarks = 0;
                document.querySelectorAll('.question-mark').forEach(function(markInput) {
                    totalQuestionMarks += parseInt(markInput.value) || 0;
                });
                document.getElementById('total-question-marks').textContent = totalQuestionMarks;
            }

            function validateTotalMarks() {
                var totalQuizMark = parseInt(document.getElementById('total_mark').value) || 0;
                var totalQuestionMarks = 0;

                var markInputs = document.querySelectorAll('.question-mark');
                markInputs.forEach(function(markInput) {
                    totalQuestionMarks += parseInt(markInput.value) || 0;
                });

                console.log("Total Quiz Mark: " + totalQuizMark);
                console.log("Total Question Marks: " + totalQuestionMarks);

                if (totalQuestionMarks !== totalQuizMark) {
                    alert('Total marks of all questions must equal Total Quiz Mark');
                    return false;
                }
                return true;
            }

            // Initial update of total question marks
            updateTotalQuestionMarks();
        });
    </script>
@endsection
