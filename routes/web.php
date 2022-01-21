<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;

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
Route::get('/home',[UserController::class , 'index']);
Route::get('/',[UserController::class , 'signIn']);
Route::get('/signup',[UserController::class , 'signUp']);
Route::post('/checksignup',[UserController::class , 'signupUser']);
Route::post('/signinauth',[UserController::class , 'signInAuth']);
Route::get('/user/addquiz',[UserController::class , 'addQuiz']);
Route::post('/user/useraddquiz',[UserController::class , 'userAddQuiz']);

Route::get('/user/addquestion',[UserController::class , 'addQuestion']);
Route::post('/user/useraddquestion',[UserController::class , 'userAddQuestion']);

Route::get('/logout',[UserController::class , 'logout']);

Route::get('/user/quiz-detail/{id}',[UserController::class , 'quizDetail']);
Route::get('/user/starquiz/{id}',[UserController::class , 'startQuiz']);
Route::post('/user/submitquiz',[UserController::class , 'submitQuiz']);








// Admin
Route::get('/admin',[AdminController::class , 'index']);
Route::get('/admin/add-quiz', function () {
    return view('add.addquiz');
});


Route::get('/admin/add-question',[AdminController::class , 'addQuestionView']);
Route::post('/addquestion',[AdminController::class , 'addQuestion']);
Route::get('/admin/view-question',[AdminController::class , 'viewQuestion']);

Route::get('/admin/quiz-approval',[AdminController::class , 'viewQuestionApproval']);
Route::get('/admin/quizapproved/{id}',[AdminController::class , 'quizApproved']);



Route::get('/admin/view-quiz',[AdminController::class , 'getAllQuizes']);
Route::get('/admin/view-quiz/{id}',[AdminController::class , 'showEditQuiz']);
Route::get('/admin/delete-quiz/{id}',[AdminController::class , 'deleteQuiz']);

Route::post('editquiz',[AdminController::class , 'editQuiz']);
Route::post('addquiz',[AdminController::class , 'addQuiz']);
