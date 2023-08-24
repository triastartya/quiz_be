<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/z_score', function () {
    return view('pages.z_score');
});

Route::get('/simpang_baku', function () {
    return view('pages.simpang_baku');
});

Route::get('/user', function () {
    return view('pages.user');
});

Route::get('/child', function () {
    return view('pages.child');
});

Route::get('/guru', function () {
    return view('pages.guru');
});

Route::get('/pengguna', function () {
    return view('pages.pengguna');
});

Route::get('/quiz', function () {
    return view('pages.quiz');
});

Route::get('/quiz_pengetahuan', function () {
    return view('pages.quiz_pengetahuan');
});

Route::get('/quiz_praktek_gizi', function () {
    return view('pages.quiz_praktek_gizi');
});

Route::get('/quiz_makanan', function () {
    return view('pages.quiz_makanan');
});
// Auth::routes();
Route::get('/', function () {
    return view('pages.login');
});
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout']);
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/belajar', function () {
    return view('pages.edukasi');
});

Route::get('/hasil', function () {
    return view('pages.hasil');
});

Route::get('/jawaban', function () {
    return view('pages.jawaban');
});

Route::group(['middleware' => ['web']], function () {
    // your routes here
});
