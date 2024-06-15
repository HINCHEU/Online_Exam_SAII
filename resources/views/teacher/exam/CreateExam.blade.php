@extends('Admin.Master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Exam</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item btn"><a href="#">Add Exam</a></li> --}}
                            <button class="btn btn-primary">
                                <a href="{{ route('exam.add') }}" style="color: white">Add Exam</a>
                            </button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12" style="display: flex">
                        @foreach ($exam as $examall)
                            <div class="card  mt-3 ml-4" style="width: 18rem;">
                                <div class="card-body">
                                    {{-- {{ dd($exam) }} --}}
                                    <h2 class="card-title" style="color: blue;font-size: 2.5rem">{{ $examall->courseName }}
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
                                        {{ $date->format('d m Y') }}
                                        <br>
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


                                    <a href="#" class="card-link">កែរប្រែ</a>
                                    <a href="{{ route('question.add') }}" class="card-link">បន្ដែមសំណួរ</a>

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

                <!-- /.row -->
            </div>
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
        </section>
        <!-- /.content -->
    </div>

@endsection
