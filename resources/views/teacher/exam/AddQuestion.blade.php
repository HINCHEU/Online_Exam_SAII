@extends('Admin.Master')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">បង្កើតតការប្រលង</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">student</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8">
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
                                <div class="card question-set mb-4">
                                    <div class="card-body">
                                        <div class="form-group ml-3">
                                            <label for="question" style="font-size: 2rem">សំណួរ {{ $count + 1 }}</label>
                                            <input type="text" name="questions[0][question]" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group ml-3">
                                            <label>ជម្រើស:</label>
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
                                            <label for="correct_answer">ចម្លើយត្រឹមត្រូវ:</label>
                                            <select name="questions[0][correct_answer]" class="form-control bg-primary"
                                                required>
                                                <option value="Option A">ជម្រើស A</option>
                                                <option value="Option B">ជម្រើស B</option>
                                                <option value="Option C">ជម្រើស C</option>
                                            </select>
                                        </div>
                                        <div class="form-group ml-5">
                                            <label for="mark">Mark:</label>
                                            <input type="text" name="questions[0][mark]" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-success" id="add-question"
                                style="background-color: rgb(198, 235, 33)">បន្ថែមសំណួរ</button>
                            <button type="submit" class="btn btn-primary">រក្សាទុក</button>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const container = document.getElementById('question-container');
                                const addButton = document.getElementById('add-question');

                                let questionIndex = {{ $count + 1 }};

                                addButton.addEventListener('click', function() {
                                    const newQuestionSet = document.createElement('div');
                                    newQuestionSet.className = 'card question-set mb-4';
                                    newQuestionSet.innerHTML = `
                                        <div class="card-body">
                                            <div class="form-group ml-3">
                                                <label for="question${questionIndex}" style="font-size: 2rem">សំណួរ ${questionIndex + 1}</label>
                                                <input type="text" name="questions[${questionIndex}][question]" class="form-control" required>
                                            </div>
                                            <div class="form-group ml-3">
                                                <label>ជម្រើស:</label>
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
                                                <label for="correct_answer${questionIndex}">ចម្លើយត្រឹមត្រូវ:</label>
                                                <select name="questions[${questionIndex}][correct_answer]" class="form-control bg-primary" required>
                                                    <option value="Option A">ជម្រើស A</option>
                                                    <option value="Option B">ជម្រើស B</option>
                                                    <option value="Option C">ជម្រើស C</option>
                                                </select>
                                            </div>
                                            <div class="form-group ml-5">
                                                <label for="mark">Mark:</label>
                                                <input type="text" name="questions[${questionIndex}][mark]" class="form-control" required>
                                            </div>
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
        </section>
        <!-- /.content -->
    </div>
@endsection
