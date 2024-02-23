<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
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
    Route::get('/lapinTable', [LapinController::class, 'lapinTable']);
    Route::get('/lapin/add', [LapinController::class, 'addLapinPage']);
    Route::post('/lapin/add', [LapinController::class, 'store']);
    Route::get('/lapin/edit/{id}', [LapinController::class, 'edit']);
    Route::post('/lapin/update/{id}', [LapinController::class, 'update'])->name('updateLapin');
    Route::get('/lapin/delete/{id}', [LapinController::class, 'delete']);
    Route::post('/lapin/reset-edit-status/{id}', [LapinController::class, 'resetEditStatus']);
    Route::get('/lapin/verificate/{id}', [LapinController::class, 'verifikasi']);
    Route::post('/lapin/grade/{id}', [LapinController::class, 'grading'])->name('gradingLapin');
    Route::get('/lapin/addLemkis/{id}', [LapinController::class, 'addLemkisPage']);

    /* Route untuk mencari data dari API */
    Route::post('/search-patient', [DataController::class, 'search']);

    /* Route untuk bagian Laporan KPC */
    Route::get('/lapkpc', [LapkpcController::class, 'lapkpc']);
    Route::get('/lapkpcTable', [LapkpcController::class, 'lapkpcTable']);
    Route::get('/lapkpc/add', [LapkpcController::class, 'addLapkpcPage']);
    Route::post('/lapkpc/add', [LapkpcController::class, 'store']);
    Route::get('/lapkpc/edit/{id}', [LapkpcController::class, 'edit']);
    Route::post('/lapkpc/update/{id}', [LapkpcController::class, 'update'])->name('updateLapkpc');
    Route::get('/lapkpc/delete/{id}', [LapkpcController::class, 'delete']);
    Route::get('/lapkpc/verificate/{id}', [LapkpcController::class, 'verifikasi']);
    Route::post('/lapkpc/grade/{id}', [LapkpcController::class, 'grading'])->name('gradingLapkpc');

    /* Route untuk bagian Lembar Kerja Investigasi Sederhana */
    Route::get('/lemkis', [LemkisController::class, 'lemkis']);
    Route::get('/lemkisTable', [LemkisController::class, 'lemkisTable']);
    Route::get('/lemkis/add', [LemkisController::class, 'addLemkisPage']);
    Route::post('/lemkis/add', [LemkisController::class, 'store']);
    Route::get('/lemkis/edit/{id}', [LemkisController::class, 'edit']);
    Route::post('/lemkis/update/{id}', [LemkisController::class, 'update'])->name('updateLemkis');
    Route::get('/lemkis/show/{id}', [LemkisController::class, 'show']);
    Route::get('/lemkis/delete/{id}', [LemkisController::class, 'delete']);

    Route::get('/lemkis/noteTable/{id}', [LemkisController::class, 'noteTable']);
    Route::get('/lemkis/addNote/{id}', [LemkisController::class, 'addNoteForm']);
    Route::post('/lemkis/addNote/{id}', [LemkisController::class, 'saveNote'])->name('addNote');


});

Route::get('/show-data', [DataController::class, 'index']);
Route::post('/save-json', [DataController::class, 'store']);


Route::get('/welcome', function (){
    return view('welcome');
});
