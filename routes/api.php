<?php

use App\Http\Controllers\QuizReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('uploadEdukasi',[App\Http\Controllers\UploadFileController::class,'edukasi']);

Route::resource('child',App\Http\Controllers\ChildController::class);
Route::get('childByNisn/{nisn}',[App\Http\Controllers\ChildController::class,'getByNisn']);


Route::get('childByUser/{id_user}',[App\Http\Controllers\ChildController::class,'getByUser']);
Route::resource('quiz',App\Http\Controllers\QuizController::class);
Route::get('quizbyjenis/{jenis_quiz}',[App\Http\Controllers\QuizController::class,'getByJenis']);
Route::get('quizbyid/{id}',[App\Http\Controllers\QuizController::class,'getById']);
Route::get('quizall',[App\Http\Controllers\QuizController::class,'getall']);

Route::post('quizReport',[QuizReportController::class,'report']);
Route::get('getreport/{id}',[QuizReportController::class,'getReport']);


Route::resource('quiz_soal',App\Http\Controllers\QuizSoalController::class);
Route::post('editQuis',[App\Http\Controllers\QuizSoalController::class,'editQuis']);
Route::post('tambahQuis',[App\Http\Controllers\QuizSoalController::class,'tambahQuis']);

Route::resource('quiz_submission',App\Http\Controllers\QuizSubmissionController::class);
Route::resource('z_score',App\Http\Controllers\ZScoreController::class);
Route::post('pemeriksaan',[App\Http\Controllers\ZScoreController::class,'pemeriksaan']);
Route::get('quiz_submission/get_by_child/{id_child}',[App\Http\Controllers\QuizSubmissionController::class,'getByChild']);
Route::get('z_score/get_by_child/{id_child}',[App\Http\Controllers\ZScoreController::class,'getByChild']);
Route::post('z_score/grafik/{id_child}',[App\Http\Controllers\ZScoreController::class,'grafik']);
Route::get('simpang_baku',[App\Http\Controllers\ZScoreController::class,'getSimpangBaku']);
Route::get('data_user_admin',[App\Http\Controllers\DataUserController::class,'get']);

Route::post('login',[App\Http\Controllers\UserController::class, 'login']);
Route::post('login_admin',[App\Http\Controllers\UserController::class, 'login_admin']);

Route::get('getAllUser',[App\Http\Controllers\UserController::class, 'getAllUser']);
Route::post('postUser',[App\Http\Controllers\UserController::class, 'postUser']);
Route::post('editUser',[App\Http\Controllers\UserController::class, 'editUser']);
Route::post('deleteUser',[App\Http\Controllers\UserController::class, 'deleteUser']);
Route::get('guru',[App\Http\Controllers\UserController::class,'guru']);
Route::get('pengguna',[App\Http\Controllers\UserController::class,'pengguna']);

Route::post('register',[App\Http\Controllers\UserController::class, 'register']);

