<?php

use App\Http\Controllers\CaseFileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CrimeController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuspectController;
use App\Http\Controllers\UserController;
use App\Models\Evidence;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('users', UserController::class)->middleware(['auth']);
Route::resource('categories', CategoryController::class)->middleware(['auth']);
Route::resource('crimes', CrimeController::class)->middleware(['auth']);
Route::resource('evidences', EvidenceController::class)->middleware(['auth']);
Route::resource('casefiles', CaseFileController::class)->middleware(['auth']);
Route::post('/make-case/{id}', [CrimeController::class, 'makeCase'])->middleware(['auth'])->name('make-case');
Route::resource('suspects', SuspectController::class)->middleware(['auth']);


require __DIR__.'/auth.php';
