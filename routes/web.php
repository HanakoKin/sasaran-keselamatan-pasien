<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LapinController;
use App\Http\Controllers\LapkpcController;
use App\Http\Controllers\LemkisController;
use App\Http\Controllers\SensusController;

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


// Entry (Login & Register) Route
Route::redirect('/', '/login');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/register', [UserController::class, 'register'])->middleware('guest');
Route::post('/register', [UserController::class, 'store']);
Route::post('/logout', [UserController::class, 'logout']);

// Route that require login before access
Route::middleware(['auth'])->group(function () {

    // Route about Laporan Insiden
    Route::get('/dashboard', [LapinController::class, 'dashboard']);
    Route::get('/lapin', [LapinController::class, 'lapin']);
    Route::get('/lapin/add', [LapinController::class, 'addLapinPage']);
    Route::post('/lapin/add', [LapinController::class, 'store']);
    Route::get('/lapin/edit/{id}', [LapinController::class, 'edit']);
    Route::post('/lapin/update/{id}', [LapinController::class, 'update'])->name('updateLapin');
    Route::get('/lapin/delete/{id}', [LapinController::class, 'delete'])->name('deleteLapin');
    Route::post('/lapin/reset-edit-status/{id}', [LapinController::class, 'resetEditStatus']);
    Route::get('/lapin/verificate/{id}', [LapinController::class, 'verifikasi']);
    Route::post('/lapin/grade/{id}', [LapinController::class, 'grading'])->name('gradingLapin');

    /* Route for getting data from API */
    Route::post('/search-patient', [DataController::class, 'search']);

    /* Route for send data to Bar Chart in Dashboard */
    Route::get('/chart-data/{year}', [LapinController::class, 'barChartLapinYear']);
    Route::get('/chart-data/{year}/{month}', [LapinController::class, 'barChartLapinMonth']);

    /* Route about LapKPC */
    Route::get('/lapkpc', [LapkpcController::class, 'lapkpc']);
    Route::get('/lapkpc/add', [LapkpcController::class, 'addLapkpcPage']);
    Route::post('/lapkpc/add', [LapkpcController::class, 'store']);
    Route::get('/lapkpc/edit/{id}', [LapkpcController::class, 'edit']);
    Route::post('/lapkpc/update/{id}', [LapkpcController::class, 'update'])->name('updateLapkpc');
    Route::get('/lapkpc/delete/{id}', [LapkpcController::class, 'delete']);
    Route::post('/lapkpc/reset-edit-status/{id}', [LapkpcController::class, 'resetEditStatus']);
    Route::get('/lapkpc/verificate/{id}', [LapkpcController::class, 'verifikasi']);
    Route::post('/lapkpc/grade/{id}', [LapkpcController::class, 'grading'])->name('gradingLapkpc');

    /* Route about Lembar Kerja Investigasi Sederhana */
    Route::get('/lemkis', [LemkisController::class, 'lemkis']);
    Route::get('/lemkis/addLemkis/{id}', [LapinController::class, 'addLemkisPage']);
    Route::post('/lemkis/add', [LemkisController::class, 'store']);
    Route::get('/lemkis/edit/{id}', [LemkisController::class, 'edit']);
    Route::post('/lemkis/update/{id}', [LemkisController::class, 'update'])->name('updateLemkis');
    Route::get('/lemkis/delete/{id}', [LemkisController::class, 'delete']);
    Route::get('/lemkis/show/{id}', [LemkisController::class, 'show']);

    /* Route for user profile & change user password */
    Route::get('/user/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/user/setting', [UserController::class, 'showSetting'])->name('settings');
    Route::post('/user/changePassword', [UserController::class, 'changePassword'])->name('changePassword');
});

// Route that require admin role to access
Route::middleware(['admin'])->group(function () {

    /* Route about user management */
    Route::get('/admin/user', [AdminController::class, 'index'])->name('users');
    Route::get('/admin/user/add', [AdminController::class, 'addUserForm'])->name('addUserForm');
    Route::post('/admin/user/add', [AdminController::class, 'addUser'])->name('addUser');
    Route::get('/admin/user/edit/{id}', [AdminController::class, 'editUser'])->name('editUser');
    Route::post('/admin/user/update/{id}', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::get('/admin/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

    // Route for getting user info
    Route::get('/get-user-info/{id}', [AdminController::class, 'getUserInfo']);

    /* Route for daily sensus management */
    Route::get('sensus/{item}', [SensusController::class, 'index']);
    Route::get('sensus/{item}/add', [SensusController::class, 'add']);
    Route::post('submit-{item}', [SensusController::class, 'store']);
    Route::get('showData-{item}', [SensusController::class, 'showData']);

});

// Route that require TIM SKP role or higher to access
Route::middleware(['skp'])->group(function () {

    // Route for Lapin, LapKPC, and LemKIS table
    Route::get('/lapinTable', [LapinController::class, 'lapinTable']);
    Route::get('/lapkpcTable', [LapkpcController::class, 'lapkpcTable']);
    Route::get('/lemkisTable', [LemkisController::class, 'lemkisTable']);
    Route::get('/lemkis/noteTable/{id}', [LemkisController::class, 'noteTable']);
    Route::get('/lemkis/addNote/{id}', [LemkisController::class, 'addNoteForm']);
    Route::post('/lemkis/addNote/{id}', [LemkisController::class, 'saveNote'])->name('addNote');
});

