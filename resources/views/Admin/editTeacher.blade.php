@extends('Admin.Master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Upadte Teacher</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Teacher </li>
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
                                    <h3 class="card-title">Teacher List</h3>
                                    <div>
                                        <form id="logout-form" action="" method="GET" style="">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('updateTeacher', $EditTeacher->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH') <!-- Since you're updating the data, use the PATCH method -->

                                    <!-- Displaying EditTeacher's information -->
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name" value="{{ $EditTeacher->name }}"
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">File input</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="exampleInputFile"
                                                    name="file" onchange="previewFile()">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                            </div>
                                        </div>
                                        <img id="previewImage" src="#" alt="File Preview"
                                            style="display: none; max-width: 10%; margin-top: 10px;">
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role:</label>
                                        <input type="text" name="role_id" id="role_id"
                                            value="{{ $EditTeacher->role_id }}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ $EditTeacher->email }}" class="form-control" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <input type="text" name="status" id="status"
                                            value="{{ $EditTeacher->status }}" class="form-control">
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>

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
    <script>
        function previewFile() {
            const preview = document.getElementById('previewImage');
            const fileInput = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block';
            }

            if (fileInput) {
                reader.readAsDataURL(fileInput);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
