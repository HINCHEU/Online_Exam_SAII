@extends('Admin.Master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="jumbotron text-center">
            <h1 class="display-3">Hi {{ Auth::user()->name }}, welcome back!</h1>
            <p class="lead">There's an exam waiting for you!</p>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <h3 class="mb-2">
                        You have {{ count($exams) }} exam{{ count($exams) > 1 ? 's' : '' }} to do.
                    </h3>
                    <div class="col-12" style="display: flex; flex-wrap: wrap;">
                        @if (count($exams) > 0)
                            @foreach ($exams as $examall)
                                <div class="card mt-3 ml-4" style="width: 18rem;">
                                    <div class="card-body">
                                        <h2 class="card-title" style="color: blue; font-size: 2.5rem">
                                            {{ $examall->courseName }}
                                        </h2>

                                        <p class="card-text">
                                            Description: {{ $examall->description }}<br>
                                            Topic: {{ $examall->topic }}
                                        </p>
                                        <p>
                                            Exam Date:
                                            @php
                                                $examDate = is_string($examall->date)
                                                    ? new \DateTime($examall->date)
                                                    : $examall->date;
                                                $startTime = is_string($examall->startDate)
                                                    ? new \DateTime($examall->startDate)
                                                    : $examall->startDate;
                                                $endTime = is_string($examall->endDate)
                                                    ? new \DateTime($examall->endDate)
                                                    : $examall->endDate;
                                            @endphp
                                            {{ $examDate->format('d m Y') }}<br>
                                            Exam Time: {{ $startTime->format('H:i') }} - {{ $endTime->format('H:i') }}
                                        </p>

                                        @php
                                            $currentDateTime = new \DateTime();
                                            $examStartDateTime = new \DateTime(
                                                $examDate->format('Y-m-d') . ' ' . $startTime->format('H:i:s'),
                                            );
                                        @endphp

                                        <div id="countdown-{{ $examall->id }}">
                                            @if ($currentDateTime < $examStartDateTime)
                                                <div class="alert alert-warning">
                                                    The exam will start on {{ $examDate->format('d m Y') }} at
                                                    {{ $startTime->format('H:i') }}.
                                                </div>
                                            @else
                                                <div class="action">
                                                    <form action="{{ route('student.attence.exam', $examall->id) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-link btn-primary"
                                                            style="padding: 0; margin: 0; color:wheat">
                                                            Take Exam
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-primary" role="alert">
                                You don't have any exams yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($exams as $exam)
                var examStartDateTime = new Date(
                    "{{ (is_string($exam->date) ? new \DateTime($exam->date) : $exam->date)->format('Y-m-d') }}T{{ (is_string($exam->startDate) ? new \DateTime($exam->startDate) : $exam->startDate)->format('H:i:s') }}"
                );
                var countdownElement = document.getElementById("countdown-{{ $exam->id }}");

                function updateCountdown() {
                    var now = new Date().getTime();
                    var distance = examStartDateTime - now;

                    if (distance > 0) {
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        countdownElement.innerHTML = '<div class="alert alert-warning">' +
                            'The exam will start on {{ $examDate->format('d m Y') }} at {{ $startTime->format('H:i') }}.' +
                            ' Time remaining: ' + days + 'd ' + hours + 'h ' + minutes + 'm ' + seconds + 's ' +
                            '</div>';
                    } else {
                        countdownElement.innerHTML = '<div class="action">' +
                            '<form action="{{ route('student.attence.exam', $exam->id) }}" method="POST" style="display:inline;">' +
                            '@csrf' +
                            '<button type="submit" class="btn btn-link btn-primary" style="padding: 0; margin: 0; color:wheat">' +
                            'Take Exam' +
                            '</button>' +
                            '</form>' +
                            '</div>';
                    }
                }

                setInterval(updateCountdown, 1000);
            @endforeach
        });
    </script>
@endsection
