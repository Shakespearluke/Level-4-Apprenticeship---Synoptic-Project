<?php

use Illuminate\Support\Facades\Route;
// Controllers
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\App\DashboardController;
use App\Http\Controllers\App\QuizzesController;

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

// Quiz - Delete Quiz
Route::get('/admin/modal-delete-quiz/{quiz_id}', [QuizzesController::class, 'modal_delete_quiz'])->name('modal_delete_quiz');
Route::post('/admin/delete-quiz/{quiz_id}', [QuizzesController::class, 'delete_quiz'])->name('delete_quiz');

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

