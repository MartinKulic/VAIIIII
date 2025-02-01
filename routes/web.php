<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionControler;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('home.index');
//});

//Route::group(['middleware' => ['auth']], function () {
//    Route::resource('home', HomeController::class);
//});

Route::get('/', [HomeController::class, 'index'])->name('home');



//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    //Route::get('/submission/new', [SubmissionController::class, 'new'])->name('submission.new');

    Route::resource('submission', SubmissionController::class);

    Route::delete('submission/{submission}/delete', [SubmissionController::class, 'destroy'])->name('submission.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
