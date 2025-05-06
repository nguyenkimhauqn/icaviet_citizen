<?php

use App\Http\Controllers\CivicsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

//  ===Auth===  
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// END Auth

Route::get('/civics/demo', function () {
    return view('civics.question');
});

Route::middleware(['auth'])->group(function () {
    // === * CIVICS * ===
    Route::get('/civics', [CivicsController::class, 'show'])->name('civics.show');
    Route::post('/civics/answer/{question}', [CivicsController::class, 'checkAnswer'])->name('civics.ajaxAnswer');
    Route::post('civics/finish-quiz', [CivicsController::class, 'finishQuiz'])->name('civics.finishQuiz');
    Route::get('/civics/result/{quiz}',[CivicsController::class, 'showResult'])->name('civics.quizResult');
    // --- Bài dấu sao ---
    Route::post('/civics/star/{question}',[CivicsController::class, 'toggleStar'])->name('civics.toggleStar');
    Route::get('/civics/starred', [CivicsController::class, 'showStarred'])->name('civics.starred');
    // === * [END] - CIVICS * ===
});
