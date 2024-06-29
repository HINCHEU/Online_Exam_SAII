@extends('Admin.Master')
@section('content')
    <style>
        .card-question {
            transition: box-shadow 0.3s;
        }

        .card-question:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Attempt the test</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-5">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="card-title">
                                    <i class="fas fa-edit"></i> Course Name: {{ $exam->courseName }} <br>
                                    <i class="ml-4">| Time:</i>
                                    <span id="countdown" style="font-size: 1.5rem;color:red"></span>
                                </h1>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Description: {{ $exam->description }}</label><br>
                                    <label>Instruction: {{ $exam->instruction }}</label><br>
                                    <label>Topic: {{ $exam->topic }}</label><br>
                                    <label>Date: {{ $exam->date }}</label><br>
                                    <label>Exam Time: {{ $exam->startDate }} - {{ $exam->endDate }}</label><br>
                                    <label>Total Mark: {{ $exam->total_mark }}</label>
                                </div>
                            </div>
                        </div>
                        <form method="POST" action="">
                            @csrf
                            <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                            @foreach ($questions as $question)
                                <div class="card mt-3 card-question">
                                    <div class="card-header">
                                        <h4>Question {{ $loop->iteration }}</h4>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $question->question_text }}</p>

                                        <div class="form-group ml-3">
                                            <label>Options:</label><br>
                                            <div>
                                                <input type="radio" id="option_a_{{ $question->id }}"
                                                    name="answers[{{ $question->id }}]" value="Option A">
                                                <label
                                                    for="option_a_{{ $question->id }}">{{ $question->answer_a }}</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="option_b_{{ $question->id }}"
                                                    name="answers[{{ $question->id }}]" value="Option B">
                                                <label
                                                    for="option_b_{{ $question->id }}">{{ $question->answer_b }}</label>
                                            </div>
                                            <div>
                                                <input type="radio" id="option_c_{{ $question->id }}"
                                                    name="answers[{{ $question->id }}]}" value="Option C">
                                                <label
                                                    for="option_c_{{ $question->id }}">{{ $question->answer_c }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary">Submit Answers</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        var startTime = "{{ $exam->startDate }}";
        var endTime = "{{ $exam->endDate }}";
        var examDate = "{{ $exam->date }}";

        var startDate = new Date(examDate + ' ' + startTime);
        var endDate = new Date(examDate + ' ' + endTime);

        function updateCountdown() {
            var now = new Date().getTime();
            var distance = endDate - now;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "EXPIRED";
            }
        }

        var x = setInterval(updateCountdown, 1000);
    </script>
@endsection
