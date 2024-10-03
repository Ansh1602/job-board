<?php

use App\Http\Controllers\Auth\EmployerAuthController;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', [JobController::class, 'search'])->name('jobs.search');
Route::get('/dashboard', [JobController::class, 'dashboard'])->name('dashboard')->middleware('auth');




// Job Routes for Employers
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [JobController::class, 'dashboard'])->name('dashboard');

    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
});


Auth::routes();
