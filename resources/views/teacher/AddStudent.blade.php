@extends('Admin.Master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add student</h1>
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
                                    <h3 class="card-title">Please Input student Information</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('student.create') }}" method="GET" enctype="multipart/form-data">
                                    @csrf
                                    @method('GET')
                                    <div class="form-group">
                                        <label for="name">Student Name:</label>
                                        <input type="text" name="stname" id="stname" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Gender</label>
                                        <select name="gender" id="" class="form-control">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Date Of Birth:</label>
                                        <input type="date" name="DateOfBirth" id="DateOfBirth" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Password:</label>
                                        <input type="text" name="password" id="password" value=""
                                            class="form-control">
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary">Add</button>
                                </form>

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
