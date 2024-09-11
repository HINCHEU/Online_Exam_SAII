@extends('Admin.Master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">បញ្ចូលសិស្ស</h1>
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
                <div class="row justify-content-center">
                    <div class="col-12 col-md-5">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title"​ style="font-size: 2rem">សូមបញ្ចូលព័ត៌មានរបស់សិស្ស</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('student.create') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">ឈ្មោះសិស្ស:</label>
                                        <input type="text" name="stname" id="stname" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">ភេទ</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="male">ប្រុស</option>
                                            <option value="female">ស្រី</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">ថ្ងៃ ខែ ឆ្នាំកំណើត:</label>
                                        <input type="date" name="DateOfBirth" id="DateOfBirth" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">អ៊ីមែល:</label>
                                        <input type="email" name="email" id="email" value=""
                                            class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="group">ក្រុម:</label>
                                        <select name="group_id" id="group_id" class="form-control" required>
                                            <option value="">ជ្រើសរើសក្រុម</option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}">{{ $group->name }}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">ពាក្យសម្ងាត់:</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary  float-right">ដាក់ស្នើរ</button>
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
