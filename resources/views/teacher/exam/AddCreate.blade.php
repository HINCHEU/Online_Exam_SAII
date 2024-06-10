@extends('Admin.Master')
@section('content')
    @dump($errors)
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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between">
                                    <h1 class="card-title">
                                        <i class="fas fa-envelope-open-text" style="font-size: 4rem"></i>
                                    </h1>

                                </div>
                            </div>
                            {{-- <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <h2>Exam Details : </h2>
                                    </div>
                                    <div class="col-6">
                                        <h2>Quiz</h2>
                                    </div>
                                </div>

                            </div> --}}
                            <div class="card-body">
                                <div class="card-title">
                                    <h1>Exam Detail</h1>
                                    <div class="card-body">
                                        <form action="{{ route('exam.save', Auth::user()->id) }}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="form-group">
                                                <label for="course_name" class="mt-3">Course Name:</label>
                                                <input type="text" name="course_name" id="course_name"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="mt-3">Descriptions:</label>
                                                <input type="text" name="description" id="description"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="instruction" class="mt-3">Instructions:</label>
                                                <input type="text" name="instruction" id="instruction"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="topic" class="mt-3">Topic:</label>
                                                <input type="text" name="topic" id="topic" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="date" class="mt-3">Date:</label>
                                                <input type="date" name="date" id="date" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="start_time" class="mt-3">Start Time:</label>
                                                <input type="time" name="start_time" id="start_time"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="end_time" class="mt-3">End Time:</label>
                                                <input type="time" name="end_time" id="end_time" class="form-control">
                                            </div>

                                            <button class="btn btn-primary" type="submit">Submit</button>

                                        </form>
                                        <hr>
                                    </div>
                                </div>
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
        </section>
    </div>
    <!-- /.row -->

    </div>


    <!-- /.content -->
    </div>


@endsection
