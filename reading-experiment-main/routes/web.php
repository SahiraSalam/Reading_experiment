<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginPageController;
use App\Http\Controllers\ConsentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SecQuestionController;
use App\Http\Controllers\ThirQuestionController;
use App\Http\Controllers\FourQuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::get('/', [LoginPageController::class, 'index'])->name('login.index');
    Route::get('/time', function () {
      return Carbon::now()->format('Uu');
    });
    Route::post('/survey/submit', [LoginPageController::class, 'submitSurvey'])->name('survey.submit');
});


Route::middleware('auth')->group(function () {

    Route::get('/consent', [LoginPageController::class, 'showConsentForm'])->name('consent.form');
    Route::post('/consent/submit', [ConsentController::class, 'submitConsent'])->name('consent.submit');


    Route::get('/passage', [ConsentController::class, 'showPassage'])->name('passage.show');
    Route::get('/questions', [ConsentController::class, 'showQuestions'])->name('questions.show');
    Route::post('/questions/submit', [QuestionController::class, 'submitQuestions'])->name('questions.submit');
    Route::get('/passage2', [QuestionController::class, 'showPassage2'])->name('passage2.show');
    Route::get('/questions2', [QuestionController::class, 'showQuestions2'])->name('questions2.show');
    Route::post('/questions2/submit', [SecQuestionController::class, 'submitQuestions2'])->name('questions2.submit');
    Route::get('/passage3', [SecQuestionController::class, 'showPassage3'])->name('passage3.show');
    Route::get('/fill-in-the-blanks', [SecQuestionController::class, 'showFillInTheBlanks'])->name('fill.in.the.blanks');
    Route::post('/fill-in-the-blanks/submit', [ThirQuestionController::class, 'submitFillInTheBlanks'])->name('fill.in.the.blanks.submit');
    Route::get('/passage4', [ThirQuestionController::class, 'showPassage4'])->name('passage4.show');
    Route::get('/quiz', [ThirQuestionController::class, 'showQuiz'])->name('quiz');
    Route::post('/quiz/submit', [FourQuestionController::class, 'quizSubmit'])->name('quiz.submit');
    Route::get('/thanks', [FourQuestionController::class, 'lastPage'])->name('last.show');

    /*=========QUESTIONS PROCESS ============*/
    Route::get('/dynamic-passage', [ConsentController::class, 'dynamicPassage'])->name('dynamic.passage');
    Route::get('/dynamic-questions', [ConsentController::class, 'questions'])->name('dynamic.questions.show');
    Route::get('/dynamic-passage-read/{passage_id}', [ConsentController::class, 'passageReadAgain'])->name('passage.back.check');

    Route::get('/logout', [LoginPageController::class, 'logout'])->name('logout');

});
