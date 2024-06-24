<?php

use App\Http\Controllers\ForTeacherController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GroupController;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Routing\Route as RoutingRoute;
use App\Http\Controllers\ExamController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\QuizeAnswerController;
use App\Models\Group;
use App\Http\Controllers\AssignExamController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
///Log out
Route::post('/logout', function () {
    Auth::logout(); // Logs the user out
    return redirect('/welcome'); // Redirect to the home page or any other desired page after logout
})->name('logout');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', function () {
    return redirect('/home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/home');  // Redirect to /home if already logged in
    } else {
        return view('welcome');
    }
});

// Teacher routes
Route::get('/index', [TeacherController::class, 'All_Teacher'])->name('all.teacher')->middleware('auth');
Route::get('/teacher', [TeacherController::class, 'show'])->name('show')->middleware('auth');

// Student route
Route::get('/student', function () {
    return view('student.index');
})->name('student')->middleware('auth');


// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Home route with role-based redirection
    Route::get('/home', function () {
        $role_id = Auth::user()->role_id;

        switch ($role_id) {
            case 1:
                return redirect('/index'); // Admin
            case 2:
                return redirect('student'); // Student
            case 3:
                // return redirect('/teacher.index'); // Teacher
                return view('teacher.index'); // Teacher
            default:
                return view('home'); // Other roles (adjust as needed)
        }
    })->name('home');
});

Route::get('/editTeacher/{id}', [TeacherController::class, 'Edit'])->name('editTeacher')->middleware('auth');
Route::patch('/updateTeacher/{id}', [TeacherController::class, 'update'])->name('updateTeacher')->middleware('auth');
Route::delete('/teachers/{teacher_id}/delete', [TeacherController::class, 'destroy'])->name('Teacher.delete')->middleware('auth');

////For teacher  --- CRUDE STUDENT
Route::get('/Teacher/student', [ForTeacherController::class, 'index'])->name('view.student')->middleware('auth');
Route::get('/Teacher/add', [ForTeacherController::class, 'show'])->name('student.add')->middleware('auth');
Route::post('/Teacher/create', [ForTeacherController::class, 'create'])->name('student.create')->middleware('auth');
Route::delete('/Teacher/{student_id}/student', [ForTeacherController::class, 'delete'])->name('student.delete')->middleware('auth');
Route::get('/Teacher/student/{student_id}', [ForTeacherController::class, 'edit'])->name('student.edit')->middleware('auth');
Route::patch('/Teacher/{student_id}/student', [ForTeacherController::class, 'update'])->name('student.update')->middleware('auth');





//For Student
Route::any('/student/login', function () {
    return view('student.login');
})->name('student.login');


//=============================================================================================
//exam

//view all exam\
Route::get('/exams', [ExamController::class, 'index'])->name('exam.show')->middleware('auth');
//view to create exam
Route::get('/exams/add', [ExamController::class, 'create'])->name('exam.add')->middleware('auth');
//save exam to Database
Route::post('/exam/save/{user_id}', [ExamController::class, 'save'])->name('exam.save')->middleware('auth');
//update exam 
Route::patch('exam/update/{exam_id}', [ExamController::class, 'update'])->name('exam.update')->middleware('auth');


//Save question
Route::post('/exam/question/save/{quize_id}', [QuizeAnswerController::class, 'create'])->name('quize.create')->middleware('auth');
//update Exam and question view
Route::patch('exam/{exam_id}', [QuizeAnswerController::class, 'updateView'])->name('question.update.view')->middleware('auth');
//Question update 
Route::patch('exam/question/update/{exam_id}', [QuizeAnswerController::class, 'update'])->name('question.update.multiple')->middleware('auth');
//Add question to exam view
Route::get('exam/question/{quize_id}', [QuizeAnswerController::class, 'index'])->name('question.add')->middleware('auth');


//Group view
Route::get('/group', [GroupController::class, 'index'])->name('group.show')->middleware('auth');
//create
Route::get('/group/add', [GroupController::class, 'show'])->name('group.add')->middleware('auth');
//create
Route::get('/group/create', [GroupController::class, 'create'])->name('group.create')->middleware('auth');
//update view
Route::get('/group/{group_id}', [GroupController::class, 'edit'])->name('group.edit')->middleware('auth');
//update action
Route::patch('/group/{group_id}', [GroupController::class, 'update'])->name('group.update')->middleware('auth');
Route::delete('/group/{group_id}', [GroupController::class, 'delete'])->name('group.delete')->middleware('auth');

//assignt exam vieww
Route::post('/exam/assign/{examId}', [AssignExamController::class, 'assignGroup'])->name('exam.assign.group');
Route::delete('/exam/{exam}/unassign-group/{group}', [AssignExamController::class, 'unassignGroup'])->name('exam.unassign.group');


require __DIR__ . '/auth.php';
