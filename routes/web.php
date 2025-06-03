<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CivicsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\WritingController;
use App\Http\Controllers\CivicsResultController;
use App\Http\Controllers\RepresentativeController;
use App\Models\Category;
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


//  ===Auth===  
Auth::routes();
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// END Auth

Route::get('/civics/demo', function () {
    return view('civics.question');
});

Route::middleware(['auth'])->group(function () {
    // === * CIVICS * ===
    Route::get('/civics', [CivicsController::class, 'show'])->name('civics.show');
    Route::post('/civics/answer/{question}', [CivicsController::class, 'checkAnswer'])->name('civics.ajaxAnswer');
    Route::post('civics/finish-quiz', [CivicsController::class, 'finishQuiz'])->name('civics.finishQuiz');
    Route::get('/civics/result/{quiz}', [CivicsController::class, 'showResult'])->name('civics.quizResult');
    // --- Bài dấu sao ---
    Route::post('/civics/star/{question}', [CivicsController::class, 'toggleStar'])->name('civics.toggleStar');
    Route::get('/civics/starred', [CivicsController::class, 'showStarred'])->name('civics.starred');
    // === * [END] - CIVICS * ===

    // === * WRITING * ===
    Route::get('/writing/{index?}', [WritingController::class, 'show'])->name('writing.show');
    Route::post('/writing/check', [WritingController::class, 'check'])->name('writing.check');
    // === * [END] - WRITING * ===

    // === * READING * ===
    Route::get('/reading/{index?}', [ReadingController::class, 'show'])->name('reading.show');
    // === * [END] - READING * ===

    // === * N400 * ===
    Route::prefix('n400')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('n400.categories.index');
        Route::get('/category/{id}/question/{index?}', [CategoryController::class, 'show'])->name('n400.category.show');
        Route::get('/category/{id}/prev', [CategoryController::class, 'prevCategory'])->name('n400.category.prev');
        Route::get('/category/{id}/next', [CategoryController::class, 'nextCategory'])->name('n400.category.next');
        Route::post('update-answer', [CategoryController::class, 'updateAnswer'])->name('n400.updateAnswer');
        Route::post('/store-question', [CategoryController::class, 'storeQuestion'])->name('n400.storeQuestion');
        Route::post('/n400/update-question', [CategoryController::class, 'updateQuestion'])->name('n400.updateQuestion');
        Route::delete('/n400/delete-question/{id}', [CategoryController::class, 'deleteQuestion'])->name('n400.deleteQuestion');
    });
    // [END] === * N400 * ===

    // === * Kết quả * ===
    Route::prefix('civics')->group(function () {
        // Trang danh sách bài kiểm tra
        Route::get('/results', [CivicsResultController::class, 'index'])->name('civics.results.index');
        // Trang chi tiết bài kiểm tra theo quiz_id
        Route::get('/results/{quiz}', [CivicsResultController::class, 'show'])->name('civics.results.show');
    });
    // [END] === * Kết quả * ===

    // === * FAQ * ===
    Route::get('/faq', function () {
        return view('faq');
    });
    // [END] === * FAQ  * ===


    // === * Representaive * ===
    Route::get('/testapi', [RepresentativeController::class, 'getRepresentative'])->name('representative.test');
    Route::get('/testapi2', [RepresentativeController::class, 'getRepresentative2'])->name('representative.test2');
    Route::get('/testapi3', [RepresentativeController::class, 'getRepresentative3'])->name('representative.test3');
    Route::get('/representative', [RepresentativeController::class, 'form'])->name('representative.form');
    Route::post('/representative', [RepresentativeController::class, 'getRepresentative'])->name('getRepresentative');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
