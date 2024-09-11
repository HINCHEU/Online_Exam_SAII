@extends('Admin.Master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="jumbotron text-center">
            <h1 class="display-3">សួស្ដី {{ Auth::user()->name }}, កាត្រឡប់មកវិញ!</h1>
            <p class="lead">មានការប្រលងកំពុងរងចាំអ្នក!</p>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <h3 class="mb-2">
                        អ្នកមានកាប្រលងចំនួន {{ count($exams) }}
                    </h3>
                    <div class="col-12" style="display: flex; flex-wrap: wrap;">
                        @if (count($exams) > 0)
                            @foreach ($exams as $exam)
                                <div class="card mt-3 ml-4" style="width: 18rem;">
                                    <div class="card-body">
                                        <h2 class="card-title" style="color: blue; font-size: 2.5rem">
                                            {{ $exam->courseName }}
                                        </h2>
                                        <p class="card-text">
                                            អំពី: {{ $exam->description }}<br>
                                            ប្រធាន: {{ $exam->topic }}
                                        </p>
                                        <p>
                                            កាលបរិច្ឆេទ:
                                            @php
                                                $examDate = is_string($exam->date)
                                                    ? new \DateTime($exam->date)
                                                    : $exam->date;
                                                $startTime = is_string($exam->startDate)
                                                    ? new \DateTime($exam->startDate)
                                                    : $exam->startDate;
                                                $endTime = is_string($exam->endDate)
                                                    ? new \DateTime($exam->endDate)
                                                    : $exam->endDate;

                                                // Set the time zone to Cambodia
                                                $timeZone = new \DateTimeZone('Asia/Phnom_Penh');
                                                $currentDateTime = new \DateTime('now', $timeZone);
                                                $examStartDateTime = new \DateTime(
                                                    $examDate->format('Y-m-d') . ' ' . $startTime->format('H:i:s'),
                                                    $timeZone,
                                                );
                                                $examEndDateTime = new \DateTime(
                                                    $examDate->format('Y-m-d') . ' ' . $endTime->format('H:i:s'),
                                                    $timeZone,
                                                );
                                            @endphp
                                            {{ $examDate->format('d m Y') }}<br>
                                            ម៉ោង: {{ $startTime->format('H:i') }} - {{ $endTime->format('H:i') }}
                                        </p>
                                        <p>ពិន្ទុ: {{ $exam->score }}/{{ $exam->full_mark }}</p>

                                        <!-- Debugging Information -->
                                        <p>Current Time: {{ $currentDateTime->format('Y-m-d H:i:s') }}</p>
                                        <p>Exam Start Time: {{ $examStartDateTime->format('Y-m-d H:i:s') }}</p>
                                        <p>Exam End Time: {{ $examEndDateTime->format('Y-m-d H:i:s') }}</p>

                                        <div id="countdown-{{ $exam->id }}">
                                            @if ($currentDateTime < $examStartDateTime)
                                                <div class="alert alert-warning">
                                                    The exam will start on {{ $examDate->format('d m Y') }} at
                                                    {{ $startTime->format('H:i') }}.
                                                </div>
                                            @elseif ($currentDateTime > $examEndDateTime)
                                                <div class="alert alert-danger">
                                                    The exam has ended.
                                                </div>
                                            @else
                                                @php
                                                    // Check if the user has already attempted any exam
                                                    $hasAttemptedAnyExam = Auth::user()
                                                        ->answers()
                                                        ->where('exam_id', $exam->id)
                                                        ->exists();
                                                @endphp

                                                @if ($hasAttemptedAnyExam)
                                                    <div class="alert alert-info">
                                                        អ្នកបានប្រលងរួចហើយ
                                                    </div>
                                                @else
                                                    <div class="action">
                                                        <form action="{{ route('student.attence.exam', $exam->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-link btn-primary"
                                                                style="padding: 0; margin: 0; color:wheat">
                                                                ប្រលង
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
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
@endsection
