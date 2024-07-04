@extends('Admin.Master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Exam Result</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Student </li> --}}

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

                    {{-- {{ dd($exam) }}  --}}
                    <div class="card col-md-6">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <select class="form-select float-right" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                @foreach ($exam as $exam)
                                    <option value="{{ $exam->topic }}">{{ $exam->topic }}</option>
                                @endforeach
                            </select>


                            <div class="table table-reponsive">
                                <table id="myTable" class="display">
                                    <thead>
                                        <tr>
                                            {{-- <th>Column 1</th>
                                            <th>Column 2</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td>Row 1 Data 1</td>
                                            <td>Row 1 Data 2</td>
                                        </tr>
                                        <tr>
                                            <td>Row 2 Data 1</td>
                                            <td>Row 2 Data 2</td>
                                        </tr> --}}
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
