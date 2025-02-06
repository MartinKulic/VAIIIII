<?php

use App\Http\Controllers\FavController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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
Route::get('/najlepsieZa/{obdobie}', [HomeController::class, 'najlepsieZa'])->name('home.najlepsieZa');
Route::get('/d/{imgID}', [HomeController::class, 'detail'])->name('image.detail');
Route::get('/s', [HomeController::class, 'search'])->name('search');

Route::get('/profile/{userID}/{what}', [ProfileController::class, 'index'])->name('profile');



//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/phpinfo', function () {
    phpinfo();
});

Route::group(['middleware' => ['auth']], function () {
    Route::resource('image', ImageController::class);

    Route::delete('image/{image}/delete', [ImageController::class, 'destroy'])->name('image.destroy');

//ajax
    Route::post("/image/{image}/rate", [ImageController::class, 'rate'])->name('image.rate');
    Route::post("/fav", [FavController::class, 'favToggle'])->name('fav.toggle');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile/changeRole', [ProfileController::class, 'changeRole'])->name('profile.changeRole');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::post('/reports', [ReportController::class, 'create'])->name('report.img');
    Route::get('report/{repID}/cancel', [ReportController::class, 'cancelReport'])->name('report.cancel');
});

require __DIR__.'/auth.php';
