<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LapinController;
use App\Http\Controllers\BandarController;
use App\Http\Controllers\LapkpcController;
use App\Http\Controllers\LemkisController;
use App\Http\Controllers\SensusController;
use App\Http\Controllers\RshusadaController;
use App\Http\Controllers\AdmissionController;

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

Route::redirect('/', '/login');

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
Route::middleware(['auth'])->group(function () {

    /* Route untuk bagian Laporan Insiden */
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

    /* Route untuk mencari data dari API */
    Route::post('/search-patient', [DataController::class, 'search']);

    /* Route untuk bar Chart */
    Route::get('/chart-data/{year}', [LapinController::class, 'barChartLapinYear']);
    Route::get('/chart-data/{year}/{month}', [LapinController::class, 'barChartLapinMonth']);

    /* Route untuk bagian Laporan KPC */
    Route::get('/lapkpc', [LapkpcController::class, 'lapkpc']);
    Route::get('/lapkpc/add', [LapkpcController::class, 'addLapkpcPage']);
    Route::post('/lapkpc/add', [LapkpcController::class, 'store']);
    Route::get('/lapkpc/edit/{id}', [LapkpcController::class, 'edit']);
    Route::post('/lapkpc/update/{id}', [LapkpcController::class, 'update'])->name('updateLapkpc');
    Route::get('/lapkpc/delete/{id}', [LapkpcController::class, 'delete']);
    Route::post('/lapkpc/reset-edit-status/{id}', [LapkpcController::class, 'resetEditStatus']);
    Route::get('/lapkpc/verificate/{id}', [LapkpcController::class, 'verifikasi']);
    Route::post('/lapkpc/grade/{id}', [LapkpcController::class, 'grading'])->name('gradingLapkpc');

    /* Route untuk bagian Lembar Kerja Investigasi Sederhana */
    Route::get('/lemkis', [LemkisController::class, 'lemkis']);
    Route::get('/lemkis/addLemkis/{id}', [LapinController::class, 'addLemkisPage']);
    Route::post('/lemkis/add', [LemkisController::class, 'store']);
    Route::get('/lemkis/edit/{id}', [LemkisController::class, 'edit']);
    Route::post('/lemkis/update/{id}', [LemkisController::class, 'update'])->name('updateLemkis');
    Route::get('/lemkis/delete/{id}', [LemkisController::class, 'delete']);
    Route::get('/lemkis/show/{id}', [LemkisController::class, 'show']);

    /* Route untuk profile dan mengganti password */
    Route::get('/user/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/user/setting', [UserController::class, 'showSetting'])->name('settings');
    Route::post('/user/changePassword', [UserController::class, 'changePassword'])->name('changePassword');


    /* Untuk Mengelola Sensus Harian */
    Route::get('sensus/{item}', [SensusController::class, 'index']);
    Route::get('sensus/{item}/add', [SensusController::class, 'add']);
    Route::post('submit-{item}', [SensusController::class, 'store']);
    Route::get('showData-{item}', [SensusController::class, 'showData']);

});

Route::middleware(['admin'])->group(function () {

    /* Untuk Mengelola User ( Admin/Dev Role ) */
    Route::get('/admin/user', [AdminController::class, 'index'])->name('users');
    Route::get('/admin/user/add', [AdminController::class, 'addUserForm'])->name('addUserForm');
    Route::post('/admin/user/add', [AdminController::class, 'addUser'])->name('addUser');
    Route::get('/admin/user/edit/{id}', [AdminController::class, 'editUser'])->name('editUser');
    Route::post('/admin/user/update/{id}', [AdminController::class, 'updateUser'])->name('updateUser');
    Route::get('/admin/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('deleteUser');

    Route::get('/get-user-info/{id}', [AdminController::class, 'getUserInfo']);
});

Route::middleware(['skp'])->group(function () {

    /* Untuk Mengelola Table ( Admin/Tim SKP Role ) */
    Route::get('/lapinTable', [LapinController::class, 'lapinTable']);
    Route::get('/lapkpcTable', [LapkpcController::class, 'lapkpcTable']);
    Route::get('/lemkisTable', [LemkisController::class, 'lemkisTable']);
    Route::get('/lemkis/noteTable/{id}', [LemkisController::class, 'noteTable']);
    Route::get('/lemkis/addNote/{id}', [LemkisController::class, 'addNoteForm']);
    Route::post('/lemkis/addNote/{id}', [LemkisController::class, 'saveNote'])->name('addNote');

    // Route::get('sensus/admission', [AdmissionController::class, 'index']);
    // Route::get('sensus/admission/add', [AdmissionController::class, 'add']);
    // Route::post('submit-admission', [AdmissionController::class, 'store']);
    // Route::get('showData-admission', [AdmissionController::class, 'showData']);

    // /* Untuk Mengelola Sensus Harian Rs Husada */
    // Route::get('test/rshusada', [RshusadaController::class, 'index']);
    // Route::get('test/rshusada/add', [RshusadaController::class, 'add']);
    // Route::post('submit-rshusada', [RshusadaController::class, 'store']);
    // Route::get('showDatas-rshusada', [RshusadaController::class, 'showData']);

    // /* Untuk Mengelola Sensus Harian Bank Darah */
    // Route::get('sensus/bandar', [BandarController::class, 'index']);
    // Route::get('sensus/bandar/add', [BandarController::class, 'add']);
    // Route::post('submit-bandar', [BandarController::class, 'store']);
    // Route::get('showData-bandar', [BandarController::class, 'showData']);
});

Route::get('/show-data', [DataController::class, 'index']);
Route::post('/save-json', [DataController::class, 'store']);


Route::get('/welcome', function () {
    return view('welcome');
});
