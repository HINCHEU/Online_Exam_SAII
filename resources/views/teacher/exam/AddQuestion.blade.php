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
                            <div class="card-body">
                                <form action="" method="POST">

                                    @csrf
                                    @method('POST')
                                    <div class="form-group ml-3">

                                        <label for="question">Question 1 </label>
                                        <input type="text" name="name" id="" class="form-control" required>
                                    </div>
                                    {{-- set question and answer --}}
                                    <div class="form-group ml-3">
                                        <label for="a">Option</label>
                                        <div class="form-group ml-5">
                                            <label for="name">A</label>
                                            <input type="text" name="a" id="" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group ml-5">
                                            <label for="b">B</label>
                                            <input type="text" name="b" id="" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group ml-5">
                                            <label for="c">C</label>
                                            <input type="text" name="c" id="" class="form-control"
                                                required>
                                        </div>
                                        {{-- option choose right answer --}}
                                    </div>
                                    <div class="form-group ml-3">
                                        <label for="name"> Right Answer: </label>
                                        <select name="right_answer" id="" class="form-control bg-primary">
                                            <option value="Option A">Option A</option>
                                            <option value="Option B">Option B</option>
                                            <option value="Option C">Option C</option>
                                        </select>
                                    </div>


                                    <button type="submit" class="btn btn-danger"> save</button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.col -->
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
