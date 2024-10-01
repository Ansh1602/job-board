<?php

use App\Http\Controllers\Auth\EmployerAuthController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', [JobController::class, 'search'])->name('jobs.search');
Route::get('/dashboard', [JobController::class, 'dashboard'])->name('dashboard')->middleware('auth');



Route::get('/employer/register', [EmployerAuthController::class, 'showRegisterForm'])->name('employer.register');
Route::post('/employer/register', [EmployerAuthController::class, 'register']);
Route::get('/employer/login', [EmployerAuthController::class, 'showLoginForm'])->name('employer.login');
Route::post('/employer/login', [EmployerAuthController::class, 'login']);
Route::post('/employer/logout', [EmployerAuthController::class, 'logout'])->name('employer.logout');


Route::middleware(['auth:employer'])->group(function () {
    Route::get('/employer/dashboard', function () {
        return view('employer.dashboard');
    })->name('employer.dashboard');
});

// Job Routes for Employers
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [JobController::class, 'dashboard'])->name('dashboard');

    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

// Public Job Routes
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');


Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create')->middleware('auth');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store')->middleware('auth');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
