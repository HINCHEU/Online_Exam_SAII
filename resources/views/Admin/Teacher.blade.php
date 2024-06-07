@extends('Admin.Master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Teacher</h1>
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
                                        {{-- <form id="logout-form" action="{{ route('editTeacher') }}" method="GET"
                                            style="">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form> --}}
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example2"
                                                class="table table-bordered table-striped  table-hover dataTable dtr-inline collapsed"
                                                aria-describedby="example2_info">
                                                <thead class="">
                                                    <tr class="bg-primary">
                                                        <th class="sorting sorting_asc" tabindex="0"
                                                            aria-controls="example2" rowspan="1" colspan="1"
                                                            aria-sort="ascending"
                                                            aria-label="Rendering engine: activate to sort column descending">
                                                            Id</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            Name
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Browser: activate to sort column ascending">
                                                            Photo
                                                        </th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Platform(s): activate to sort column ascending">
                                                            Role</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1" style=""
                                                            aria-label="CSS grade: activate to sort column ascending">
                                                            Email</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1" style=""
                                                            aria-label="CSS grade: activate to sort column ascending">
                                                            Status</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1" style=""
                                                            aria-label="CSS grade: activate to sort column ascending">
                                                            Create At</th>
                                                        <th class="sorting" tabindex="0" aria-controls="example2"
                                                            rowspan="1" colspan="1" style=""
                                                            aria-label="CSS grade: activate to sort column ascending">
                                                            Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($Teachers as $teacher)
                                                        <tr class="">

                                                            <td class="dtr-control sorting_1" tabindex="0">
                                                                {{ $teacher->id }}</td>
                                                            <td> {{ $teacher->name }}</td>
                                                            <th>
                                                                @if ($teacher->user_image != null)
                                                                    <img src="{{ $teacher->user_image }}" alt=""
                                                                        sizes="" style="max-height: 50px">
                                                                @else
                                                                    <img src=" {{ asset('logo/cheu.png') }}" alt=""
                                                                        sizes="" style="max-height: 50px">
                                                                @endif
                                                            </th>
                                                            <td>{{ $teacher->role->name }}</td>
                                                            <td style=""> {{ $teacher->email }}</td>
                                                            <td style="">
                                                                @if ($teacher->status == 1)
                                                                    Active
                                                                @else
                                                                    Inactive
                                                                @endif
                                                            </td>
                                                            <td style=""> {{ $teacher->created_at }}</td>
                                                            <td style="display: flex;">
                                                                <form id="logout-form" class="ml-1"
                                                                    action="{{ route('editTeacher', ['id' => $teacher->id]) }}"
                                                                    method="GET" style="">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-warning">Update</button>
                                                                </form>
                                                                <form id="deleteForm" class="ml-1"
                                                                    action="{{ route('Teacher.delete', $teacher->id) }}"
                                                                    style="" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <button type="button" class="btn btn-danger"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#myModal">Delete</button>
                                                                </form>

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tfoot>
                                            </table>

                                            {{-- Module --}}

                                            <div class="modal" id="myModal">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Confirm Delete</h4>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Do you want to delete this permanently?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-danger"
                                                                onclick="deleteMovie()">Yes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Module --}}

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-5">
                                            <div class="dataTables_info" id="example2_info" role="status"
                                                aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                        </div>
                                        <div class="col-sm-12 col-md-7">
                                            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                                <ul class="pagination">
                                                    <li class="paginate_button page-item previous disabled"
                                                        id="example2_previous"><a href="#" aria-controls="example2"
                                                            data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                                                    </li>
                                                    <li class="paginate_button page-item active"><a href="#"
                                                            aria-controls="example2" data-dt-idx="1" tabindex="0"
                                                            class="page-link">1</a></li>
                                                    <li class="paginate_button page-item "><a href="#"
                                                            aria-controls="example2" data-dt-idx="2" tabindex="0"
                                                            class="page-link">2</a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->


                        <!-- /.card -->
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
        function deleteMovie() {
            document.getElementById('deleteForm').submit();
        }
    </script>
@endsection
