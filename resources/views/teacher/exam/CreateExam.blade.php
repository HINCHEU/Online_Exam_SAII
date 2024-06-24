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
                        @if (count($exams) > 0)
                            @foreach ($exams as $examall)
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
                                                style="margin-left: 0;">បន្ដែមសំណួរ</a>​ <br>
                                            <!-- Link to trigger the modal -->
                                            <a href="#" class="card-link" style="margin-left: 0;" data-toggle="modal"
                                                data-target="#assignGroupModal-{{ $examall->id }}">Assign Group</a>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="assignGroupModal-{{ $examall->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="assignGroupModalLabel-{{ $examall->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="assignGroupModalLabel-{{ $examall->id }}">Assign Group
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('exam.assign.group', $examall->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="group">Select Group</label>
                                                                <select name="group_id" class="form-control" id="group">
                                                                    @foreach ($groups as $group)
                                                                        <option value="{{ $group->id }}">
                                                                            {{ $group->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Assign</button>
                                                        </form>
                                                        <hr>
                                                        <div class="form-group">
                                                            <label>Assigned Group:</label>
                                                            <ul>
                                                                @if (isset($assignedGroups[$examall->id]))
                                                                    @foreach ($assignedGroups[$examall->id] as $assignedGroup)
                                                                        <li>
                                                                            {{ $assignedGroup->group->name }}
                                                                            <form
                                                                                action="{{ route('exam.unassign.group', ['exam' => $examall->id, 'group' => $assignedGroup->group->id]) }}"
                                                                                method="POST" style="display: inline;">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                    class="btn btn-danger btn-sm mt-2">Unassign</button>
                                                                            </form>
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li>No groups assigned</li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
