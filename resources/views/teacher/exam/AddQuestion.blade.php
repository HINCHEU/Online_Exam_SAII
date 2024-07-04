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
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">student </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-5">
                        <div class="card">
                            <div class="card-header ">
                                <div class="d-flex justify-content-between">
                                    <h1 class="card-title">
                                        <i class="fas fa-envelope-open-text" style="font-size: 4rem"></i>
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

                                <form action="{{ route('quize.create', $quize_id) }}" method="POST">
                                    @csrf
                                    <div id="question-container">
                                        <div class="question-set">
                                            <div class="form-group ml-3">
                                                <label for="question" style="font-size: 2rem">Question
                                                    {{ $count + 1 }}</label>
                                                <input type="text" name="questions[0][question]" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label>Options:</label>
                                                <div class="form-group ml-5">
                                                    <label for="answer_a">A</label>
                                                    <input type="text" name="questions[0][answer_a]" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="answer_b">B</label>
                                                    <input type="text" name="questions[0][answer_b]" class="form-control"
                                                        required>
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="answer_c">C</label>
                                                    <input type="text" name="questions[0][answer_c]" class="form-control"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label for="correct_answer">Right Answer:</label>
                                                <select name="questions[0][correct_answer]" class="form-control bg-primary"
                                                    required>
                                                    <option value="Option A">Option A</option>
                                                    <option value="Option B">Option B</option>
                                                    <option value="Option C">Option C</option>
                                                </select>
                                            </div>
                                            <div class="form-group ml-5">
                                                <label for="mark">Mark:</label>
                                                <input type="text" name="questions[0][mark]" class="form-control"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-primary" id="add-question">Add Question</button>
                                    <button type="submit" class="btn btn-danger">Save</button>
                                </form>

                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const container = document.getElementById('question-container');
                                        const addButton = document.getElementById('add-question');

                                        let questionIndex = {{ $count + 1 }};

                                        addButton.addEventListener('click', function() {
                                            const newQuestionSet = document.createElement('div');
                                            newQuestionSet.className = 'question-set';
                                            newQuestionSet.innerHTML = `
                                                <div class="form-group ml-3">
                                                    <label for="question${questionIndex}" style="font-size: 2rem">Question ${questionIndex + 1}</label>
                                                    <input type="text" name="questions[${questionIndex}][question]" class="form-control" required>
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label>Options:</label>
                                                    <div class="form-group ml-5">
                                                        <label for="answer_a">A</label>
                                                        <input type="text" name="questions[${questionIndex}][answer_a]" class="form-control" required>
                                                    </div>
                                                    <div class="form-group ml-5">
                                                        <label for="answer_b">B</label>
                                                        <input type="text" name="questions[${questionIndex}][answer_b]" class="form-control" required>
                                                    </div>
                                                    <div class="form-group ml-5">
                                                        <label for="answer_c">C</label>
                                                        <input type="text" name="questions[${questionIndex}][answer_c]" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="form-group ml-3">
                                                    <label for="correct_answer${questionIndex}">Right Answer:</label>
                                                    <select name="questions[${questionIndex}][correct_answer]" class="form-control bg-primary" required>
                                                        <option value="Option A">Option A</option>
                                                        <option value="Option B">Option B</option>
                                                        <option value="Option C">Option C</option>
                                                    </select>
                                                </div>
                                                <div class="form-group ml-5">
                                                    <label for="mark">Mark:</label>
                                                    <input type="text" name="questions[${questionIndex}][mark]" class="form-control" required>
                                                </div>
                                            `;
                                            container.appendChild(newQuestionSet);
                                            questionIndex++;
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            {{-- @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}
        </section>
        <!-- /.content -->
    </div>
@endsection
