<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LapinController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LapkpcController;
use App\Http\Controllers\LemkisController;

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

/*
|--------------------------------------------------------------------------
| Route untuk bagian entry
|--------------------------------------------------------------------------
*/
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/register', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Route yang sudah berfungsi CRUD nya
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function(){

    /* Route untuk bagian Laporan Insiden */
    Route::get('/dashboard', [LapinController::class, 'dashboard']);
    Route::get('/lapin', [LapinController::class, 'lapin']);
    Route::get('/addLapin', [LapinController::class, 'addLapinPage']);
    Route::post('/addLapin', [LapinController::class, 'store']);
    Route::get('/editLapin/{id}', [LapinController::class, 'edit']);
    Route::post('/updateLapin/{id}', [LapinController::class, 'update'])->name('updateLapin');
    Route::get('/deleteLapin/{id}', [LapinController::class, 'delete']);

    Route::get('/verifikasiLapin/{id}', [LapinController::class, 'verifikasi']);
    Route::post('/gradingLapin/{id}', [LapinController::class, 'grading'])->name('gradingLapin');


    /* Route untuk bagian Laporan KPC */
    Route::get('/lapkpc', [LapkpcController::class, 'lapkpc']);
    Route::get('/addLapkpc', [LapkpcController::class, 'addLapkpcPage']);
    Route::post('/addLapkpc', [LapkpcController::class, 'store']);
    Route::get('/editLapkpc/{id}', [LapkpcController::class, 'edit']);
    Route::post('/updateLapkpc/{id}', [LapkpcController::class, 'update'])->name('updateLapkpc');
    Route::get('/deleteLapkpc/{id}', [LapkpcController::class, 'delete']);

    Route::get('/verifikasiLapkpc/{id}', [LapkpcController::class, 'verifikasi']);
    Route::post('/gradingLapkpc/{id}', [LapkpcController::class, 'grading'])->name('gradingLapkpc');

    /* Route untuk bagian Lembar Kerja Investigasi Sederhana */
    Route::get('/lemkis', [LemkisController::class, 'lemkis']);
    Route::get('/addLemkis', [LemkisController::class, 'addLemkisPage']);
    Route::post('/addLemkis', [LemkisController::class, 'store']);
    Route::get('/editLemkis/{id}', [LemkisController::class, 'edit']);
    Route::post('/updateLemkis/{id}', [LemkisController::class, 'update'])->name('updateLemkis');
    Route::get('/deleteLemkis/{id}', [LemkisController::class, 'delete']);

});





Route::get('/welcome', function (){
    return view('welcome');
});
