@extends('Admin.Master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Attempt the test</h1>
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
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h1 class="card-title" style="font-size: 2rem">

                                        <i class="fas fa-edit" style=""></i> Course Name:
                                        {{ $exam->courseName }}
                                        <i>| Time: </i>

                                    </h1>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="">
                                    @csrf
                                    @method('PATCH')

                                    <div class="form-group">

                                        <label for="description" class="mt-3">Description:{{ $exam->description }}</label>
                                        <br>
                                        <label for="instruction" class="mt-3">Instruction:{{ $exam->instruction }}</label>
                                        <br>
                                        <label for="topic" class="mt-3">Topic:{{ $exam->topic }}</label>
                                        <br>
                                        <label for="date" class="mt-3">Date:{{ $exam->date }}</label>
                                        <br>
                                        <label for="start_time" class="mt-3">Exam Time:{{ $exam->startDate }} -
                                            :{{ $exam->endDate }}</label>
                                        <br>
                                        <label for="end_time" class="mt-3">Total Mark: {{ $quize->total_mark }}</label>

                                    </div>





                                </form>
                                <hr>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h1 class="card-title">
                                        <i class="fas fa-edit" style="font-size: 4rem;"></i> Question
                                    </h1>
                                </div>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('question.update.multiple', $exam->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')

                                    @foreach ($questions as $question)
                                        <div class="question-set mb-3">
                                            <input type="hidden" name="question_ids[]" value="{{ $question->id }}">

                                            <div class="form-group ml-3">
                                                <label for="question{{ $question->id }}" style="font-size: 2rem">Question
                                                    {{ $loop->iteration }}</label>
                                                <input type="text" name="questions[{{ $question->id }}][question]"
                                                    class="form-control"
                                                    value="{{ old('questions.' . $question->id . '.question', $question->question_text) }}"
                                                    required>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label>Options:</label>
                                                <div class="form-group ml-5">
                                                    <label for="answer_a{{ $question->id }}">A</label>
                                                    <input type="text" name="questions[{{ $question->id }}][answer_a]"
                                                        class="form-control"
                                                        value="{{ old('questions.' . $question->id . '.answer_a', $question->answer_a) }}"
                                                        required>
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="answer_b{{ $question->id }}">B</label>
                                                    <input type="text" name="questions[{{ $question->id }}][answer_b]"
                                                        class="form-control"
                                                        value="{{ old('questions.' . $question->id . '.answer_b', $question->answer_b) }}"
                                                        required>
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="answer_c{{ $question->id }}">C</label>
                                                    <input type="text" name="questions[{{ $question->id }}][answer_c]"
                                                        class="form-control"
                                                        value="{{ old('questions.' . $question->id . '.answer_c', $question->answer_c) }}"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label for="correct_answer{{ $question->id }}">Right Answer:</label>
                                                <select name="questions[{{ $question->id }}][correct_answer]"
                                                    class="form-control bg-primary" required>
                                                    <option value="Option A"
                                                        {{ $question->correct_answer === 'Option A' ? 'selected' : '' }}>
                                                        Option A</option>
                                                    <option value="Option B"
                                                        {{ $question->correct_answer === 'Option B' ? 'selected' : '' }}>
                                                        Option B</option>
                                                    <option value="Option C"
                                                        {{ $question->correct_answer === 'Option C' ? 'selected' : '' }}>
                                                        Option C</option>
                                                </select>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label for="mark{{ $question->id }}">Mark:</label>
                                                <input type="text" name="questions[{{ $question->id }}][mark]"
                                                    class="form-control"
                                                    value="{{ old('questions.' . $question->id . '.mark', $question->mark) }}"
                                                    required>
                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <div class="float-sm-right">
                                        <button type="" class="btn btn-warning">
                                            <a href="{{ route('exam.show') }}" style="color: red">Cancel</a>
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
