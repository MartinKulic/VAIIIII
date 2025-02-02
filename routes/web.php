<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionControler;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('home.index');
//});

//Route::group(['middleware' => ['auth']], function () {
//    Route::resource('home', HomeController::class);
//});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/d/{imgID}', [HomeController::class, 'detail'])->name('image.detail');



//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    //Route::get('/submission/new', [SubmissionController::class, 'new'])->name('submission.new');

    Route::resource('image', ImageController::class);

    Route::delete('image/{image}/delete', [ImageController::class, 'destroy'])->name('image.destroy');

//ajax
    Route::post("/image/{image}/rate", [ImageController::class, 'rate'])->name('image.rate');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
