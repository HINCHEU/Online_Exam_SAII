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
                            <li class="breadcrumb-item active">Dashboard </li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="jumbotron text-center">
            <h1 class="display-3">Hi {{ Auth::user()->name }}, welcome back!</h1>
            <p class="lead">There's exam waiting for you!</p>
            {{-- <a class="btn btn-primary btn-lg" href="#">Explore Now</a> --}}
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row ">
                    <h3 class="mb-2">
                        You have {{ count($exams) }} exam{{ count($exams) > 1 ? 's' : '' }} to do.
                    </h3>
                    <div class="col-12 " style="display: flex; flex-wrap: wrap;">
                        {{-- {{ dd($exams) }} --}}
                        @if (count($exams) > 0)
                            @foreach ($exams as $examall)
                                <div class="card mt-3 ml-4" style="width: 18rem;">
                                    <div class="card-body">
                                        <h2 class="card-title" style="color: blue;font-size: 2.5rem">
                                            {{ $examall->courseName }}
                                        </h2>

                                        <p class="card-text">
                                            អំពី : {{ $examall->description }}<br>
                                            មុខវិជ្ចា: {{ $examall->topic }}
                                        </p>
                                        <p>
                                            ប្រលងនៅ​ :
                                            @php
                                                $date = is_string($examall->date)
                                                    ? new \DateTime($examall->date)
                                                    : $examall->date;
                                            @endphp
                                            {{ $date->format('d m Y') }}<br>
                                            ម៉ោងប្រលង:
                                            @php
                                                $startDate = is_string($examall->startDate)
                                                    ? new \DateTime($examall->startDate)
                                                    : $examall->startDate;
                                                $endDate = is_string($examall->endDate)
                                                    ? new \DateTime($examall->endDate)
                                                    : $examall->endDate;
                                            @endphp
                                            {{ $startDate->format('H:i') }} - {{ $endDate->format('H:i') }}
                                        </p>
                                        <div class="action">


                                            <form action="{{ route('student.attence.exam', $examall->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-link"
                                                    style="text-decoration: none; padding: 0; margin: 0; background: none; border: none; color: inherit; cursor: pointer;">
                                                    ប្រលង
                                                </button>
                                            </form>

                                            <!-- Link to trigger the modal -->

                                        </div>


                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-primary" role="alert">
                                You don't have an Exam yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
