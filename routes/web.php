<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\QuizController;
use App\Http\Controllers\Auth\LoginWithGoogleController;
use App\Http\Controllers\Auth\LoginWithFacebookController;

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



Route::group( [
    'middleware' => [
        'auth',
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
        ],
    ], function()
{
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('user', UserController::class);

Route::get('quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::post('quiz', [QuizController::class, 'store']);

Route::get('quiz/edit/{slug}', [QuizController::class, 'edit'])->name('quiz.edit');
Route::post('quiz/edit/{slug}', [QuizController::class, 'update']);

Route::delete('quiz/delete', [QuizController::class, 'destroy'])->name('quiz.destroy');
Route::post('quiz/invite/{slug}', [QuizController::class, 'invite'])->name('quiz.invite');

Route::get('quiz/accept/{slug}/{token}', [QuizController::class, 'accept'])->name('quiz.accept');
Route::post('quiz/accept/{slug}/{token}', [QuizController::class, 'answer']);
});

Route::get('/redirect', [LoginWithFacebookController::class, 'redirectFacebook']);
Route::get('/callback', [LoginWithFacebookController::class, 'facebookCallback']);



Route::get('authorized/google', [LoginWithGoogleController::class, 'redirectToGoogle']);
Route::get('authorized/google/callback', [LoginWithGoogleController::class, 'handleGoogleCallback']);