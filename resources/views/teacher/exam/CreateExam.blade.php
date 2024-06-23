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
                <div class="row ">
                    <div class="col-12 " style="display: flex; flex-wrap: wrap;">
                        @if (count($exam) > 0)
                            @foreach ($exam as $examall)
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
                                            <form action="{{ route('question.update.view', $examall->id) }}" method="POST"
                                                class="card-link" style="margin-left: 0;">
                                                @method('PATCH')
                                                @csrf
                                                <button type="submit"
                                                    style="text-decoration: none; background: none; border: none; color: inherit; cursor: pointer;color:red">កែរប្រែ</button>
                                            </form>

                                            <a href="{{ route('question.add', $examall->id) }}" class="card-link"
                                                style="margin-left: 0;">បន្ដែមសំណួរ</a>
                                        </div>




                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="alert alert-primary" role="alert">
                                You don't have an Exam yet. <a href="{{ route('exam.add') }}" class="alert-link">Create
                                    one</a>.
                                Give it a click if you like.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>


        <!-- /.content -->
    </div>
@endsection
