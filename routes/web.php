<?php

use App\Http\Controllers\Admin\CandidateController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::middleware(['guest'])->group(function () {
    // Auth
    Route::get('/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/admin/login', [AuthController::class, 'adminShowLogin'])->name('auth.admin.showLogin');
    Route::post('/admin/login', [AuthController::class, 'adminLogin'])->name('auth.admin.login');
});

Route::group(['middleware' => ['auth']], function () {
    // Admin Routes

    Route::get('/candidate/visimisi', [HomeController::class, 'visimisi'])->name('candidate.visimisi');
    Route::get('/candidate/pilih', [HomeController::class, 'pilih'])->name('candidate.pilih');
    Route::post('/candidate/pilih', [HomeController::class, 'storePilih'])->name('candidate.store.pilih');
    Route::get('/api/chart-vote', [DashboardController::class, 'getChartDataVote'])->name('vote.chart');

    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['role:adm']], function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
        Route::put('/update/{id}', [AuthController::class, 'update'])->name('auth.update');

        // Master Pemilih
        Route::get('/pemilih', [DashboardController::class, 'pemilih'])->name('pemilih.index');
        Route::delete('/pemilih/{id}', [DashboardController::class, 'destroyPemilih'])->name('pemilih.destroy');

        // Master Admin
        // Route::get('/master/export', [AdminController::class, 'export'])->name('master.export');
        // Route::post('/master/import', [AdminController::class, 'import'])->name('master.import');
        // Route::resource('master', AdminController::class);

        // Master Student
        Route::get('/student/export', [StudentController::class, 'export'])->name('student.export');
        Route::post('/student/import', [StudentController::class, 'import'])->name('student.import');
        Route::resource('student', StudentController::class);

        // Master Teacher
        Route::get('/teacher/export', [TeacherController::class, 'export'])->name('teacher.export');
        Route::post('/teacher/import', [TeacherController::class, 'import'])->name('teacher.import');
        Route::resource('teacher', TeacherController::class);

        // Master Candidate
        Route::resource('candidate', CandidateController::class);

        // Master Settings
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::get('/setting/create', [SettingController::class, 'create'])->name('setting.create');
        Route::put('/setting/update-logo', [SettingController::class, 'updateLogo'])->name('setting.updateLogo');
        Route::put('/setting/update-data', [SettingController::class, 'updateData'])->name('setting.updateData');
    });

    // User Routes
    Route::group(['middleware' => ['role:usr']], function () {
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('user.dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::get('/seed', function () {
    Artisan::call('db:seed');
    return true;
});

Route::get('/clear', function () {
    Artisan::call('route:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return true;
});