<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CivicsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReadingController;
use App\Http\Controllers\WritingController;
use App\Http\Controllers\CivicsResultController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\WhisperController;
use App\Http\Controllers\GoogleSpeechController;
use App\Http\Controllers\MockTestController;
use App\Http\Controllers\N400Controller;
use App\Http\Controllers\QAndAController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VocabularyController;
use Illuminate\Support\Facades\Storage;


use App\Models\Category;
use App\Models\Representative;
use Faker\Guesser\Name;
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
    Route::get('/civics/form', [CivicsController::class, 'form'])->name('civics.form');
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
    // Route::post('/writing/check', [WritingController::class, 'check'])->name('writing.check');
    Route::post('/writing/check-ajax', [WritingController::class, 'checkAjax'])->name('writing.check.ajax');

    // === * [END] - WRITING * ===

    // === * READING * ===
    Route::get('/reading/{index?}', [ReadingController::class, 'show'])->name('reading.show');
    // === * [END] - READING * ===

    // === * N400 * ===
    Route::prefix('n400')->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('n400.categories.index');

        // Route::get('/category/{id}/question/{index?}', [CategoryController::class, 'show'])->name('n400.category.show');
        Route::get('/category/{id}/question', [N400Controller::class, 'show'])->name('n400.category.show');
        Route::post('/questions', [N400Controller::class, 'store'])->name('n400.store');
        Route::delete('/n400/{id}/delete', [N400Controller::class, 'destroy'])->name('n400.destroy');


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

    // === * Mock Test * ===
    Route::get('/mock-test', [MockTestController::class, 'show'])->name('mock-test.list');
    Route::get('/start-mock-test/{slug}', [MockTestController::class, 'start'])->name('start.mock-test');
    Route::post('/mock-test/{slug}/submit', [MockTestController::class, 'submitAnswer'])->name('submit.answer');
    Route::get('/mock-test/{slug}/prepare', [MockTestController::class, 'prepare'])->name('mock-test.prepare');
    Route::get('/mock-test/result', [MockTestController::class, 'showResult'])->name('mock-test.result');
    // [END] === * Mock Test * ===
    Route::get('/result', [ResultController::class, 'index'])->name('result.index');
    Route::get('/result/mock-test', [ResultController::class, 'show'])->name('result.mock-test');
    Route::get('/result/detail/{attemptId}', [ResultController::class, 'showDetail'])->name('result.detail');

    // === * FAQ * ===
    Route::get('/faq', function () {
        return view('faq');
    });
    // [END] === * FAQ  * ===

    // === * Q & A * ===
    Route::get('/q-and-a', [QAndAController::class, 'index'])->name('qa.index');
    Route::get('/a-and-a/form', [QAndAController::class, 'showForm'])->name('qa.show-form');

    // === * Vocabulary * ===
    Route::get('/vocabulary', [VocabularyController::class, 'index'])->name('vocabulary.index');

    // === * PROFILE * ===
    Route::get('/user/profile/', [UserController::class, 'show'])->name('user.profile');
    Route::post('/user/delete-learned-data', [UserController::class, 'deleteLearnedData'])->name('user.deleteLearnedData');
    // [END] === * PROFILE * ===

    // === * Representaive * ===
    Route::get('/testapi', [RepresentativeController::class, 'getRepresentative'])->name('representative.test');
    Route::get('/testapi2', [RepresentativeController::class, 'getRepresentative2'])->name('representative.test2');
    Route::get('/testapi3', [RepresentativeController::class, 'getRepresentative3'])->name('representative.test3');
    Route::get('/representative', [RepresentativeController::class, 'form'])->name('representative.form');
    Route::post('/representative', [RepresentativeController::class, 'getRepresentative'])->name('getRepresentative');

    // TEST READING
    Route::get('/recorder', [ReadingController::class, 'index'])->name('recorder.index');
    Route::post('/recorder/upload', [ReadingController::class, 'upload'])->name('recorder.upload');
    Route::get('/test-upload-mp3', [ReadingController::class, 'testStaticFile']);
    // TEST OPEN AI
    Route::post('/transcribe', [WhisperController::class, 'transcribe'])->name('whisper.transcribe');
    Route::view('/record', 'record');
    // TEST API: Assembly;
    // Route::post('/transcribe-assembly', [WhisperController::class, 'transcribeAssembly'])->name('whisper.transcribeAssembly');
    Route::view('/transcribeAssembly', 'transcribeAssembly');

    // TEST API Google
    Route::post('/google', [GoogleSpeechController::class, 'transcribe'])->name('google.transcribe');
    Route::view('/google-form', 'google_form');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
