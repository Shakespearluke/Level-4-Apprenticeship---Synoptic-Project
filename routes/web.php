<?php

use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\App\QuizzesController;
use App\Http\Controllers\App\QuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app/dashboard');
});

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

// Login
Route::get('/login',[LoginController::class, 'index'])->name('login');
Route::post('/login',[LoginController::class, 'login']);
// Logout
Route::post('/logout',[LogoutController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| App Routes
|--------------------------------------------------------------------------
*/

// Dashboard
Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');

// Dashboard - Quiz Table
Route::get('/dashboard/table-quizzes', [DashboardController::class, 'get_quizzes_table'])->name('get_quizzes_table');

// Quiz - Create Quiz
Route::get('/quiz/create', [QuizzesController::class, 'create_quiz'])->name('create_quiz');
Route::post('/quiz/create', [QuizzesController::class, 'store_quiz']);

// Quiz - Delete Quiz
Route::get('/dashboard/modal-delete-quiz/{quiz_id}', [QuizzesController::class, 'modal_delete_quiz'])->name('modal_delete_quiz');
Route::post('/dashboard/delete-quiz/{quiz_id}', [QuizzesController::class, 'delete_quiz'])->name('delete_quiz');

// Quiz - Questions Table
Route::get('/dashboard/table-questions', [QuizzesController::class, 'get_questions_table'])->name('get_questions_table');

// Quiz - Add Question
Route::get('/quiz/modal-add-question', [QuestionController::class, 'modal_add_question'])->name('modal_add_question');
Route::get('/quiz/edit/modal-add-question', [QuestionController::class, 'modal_add_question'])->name('modal_add_question');

// Quiz - Edit Question
Route::get('/quiz/modal-edit-question', [QuestionController::class, 'modal_edit_question'])->name('modal_edit_question');
Route::get('/quiz/edit/modal-edit-question', [QuestionController::class, 'modal_edit_question'])->name('modal_edit_question');

// Quiz - Add Answer
Route::get('/quiz/modal-add-answer', [QuestionController::class, 'modal_add_answer'])->name('modal_add_answer');
Route::get('/quiz/edit/modal-add-answer', [QuestionController::class, 'modal_add_answer'])->name('modal_add_answer');

// Quiz - Edit Answer
Route::get('/quiz/modal-edit-answer', [QuestionController::class, 'modal_edit_answer'])->name('modal_edit_answer');
Route::get('/quiz/edit/modal-edit-answer', [QuestionController::class, 'modal_edit_answer'])->name('modal_edit_answer');

// Quiz - Edit Quiz
Route::get('/quiz/edit/{quiz_id}', [QuizzesController::class, 'edit_quiz'])->name('edit_quiz');
Route::post('/quiz/edit/{quiz_id}', [QuizzesController::class, 'store_edited_quiz']);

// Quiz - View Quiz
Route::get('/quiz/view/{quiz_id}',[QuizzesController::class, 'view_quiz'])->name('view_quiz');


/*
|-------------------------------------------------------------------------
| Alerts
|-------------------------------------------------------------------------
*/

// Success
Route::get('alert-success', function(){
    return view('alerts.success');
});
// Error
Route::get('alert-error', function(){
    return view('alerts.error');
});

