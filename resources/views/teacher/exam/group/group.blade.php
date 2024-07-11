@extends('Admin.Master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Group</h1>
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
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between">
                                    <div class="display-flex">
                                        <i class="fas fa-user-graduate" style="font-size: 4rem"></i>

                                    </div>

                                    <div>
                                        <form id="logout-form" action="{{ route('group.add') }}" method="GET"
                                            style="">
                                            @csrf
                                            <button class="btn btn-primary">+ Add </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success ml-2 mr-2">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"></div>
                                        <div class="col-sm-12 col-md-6"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="table-responsive">
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
                                                                Group Name
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example2"
                                                                rowspan="1" colspan="1"
                                                                aria-label="Browser: activate to sort column ascending">
                                                                Discription
                                                            </th>
                                                            <th class="sorting" tabindex="0" aria-controls="example2"
                                                                rowspan="1" colspan="1" style=""
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Status</th>
                                                            <th class="sorting" tabindex="0" aria-controls="example2"
                                                                rowspan="1" colspan="1" style=""
                                                                aria-label="CSS grade: activate to sort column ascending">
                                                                Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($groups as $group)
                                                            <tr class="">
                                                                <td class="dtr-control sorting_1" tabindex="0">
                                                                    {{ $group->id }}</td>
                                                                <td>{{ $group->name }}</td>
                                                                <td>{{ $group->desc }}</td>
                                                                <td>{{ $group->status }}</td>


                                                                <td style="display: flex;">
                                                                    <form id="updateForm{{ $group->id }}" class="ml-1"
                                                                        action="{{ route('group.edit', ['group_id' => $group->id]) }}"
                                                                        method="GET">
                                                                        @csrf
                                                                        @method('GET')
                                                                        <button type="submit"
                                                                            class="btn btn-warning">Update</button>
                                                                    </form>
                                                                    <form class="ml-1 deleteForm"
                                                                        id="deleteForm{{ $group->id }}"
                                                                        action="{{ route('group.delete', ['group_id' => $group->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-danger"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#myModal{{ $group->id }}">Delete</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tfoot>
                                                </table>
                                            </div>


                                            {{-- Module --}}

                                            <!-- Modals -->
                                            @foreach ($groups as $group)
                                                <div class="modal" id="myModal{{ $group->id }}">
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
                                                                    onclick="deleteStudent('deleteForm{{ $group->id }}')"
                                                                    data-bs-dismiss="modal">Yes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            {{-- Module --}}

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
        function deleteStudent(formId) {
            document.getElementById(formId).submit();
        }
    </script>
@endsection
