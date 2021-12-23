<?php

use App\Http\Controllers\AuthGoogleController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group([
    'as' => 'auth.'
], function () {
    Route::get('auth/google/redirect', [AuthGoogleController::class, 'redirect'])
        ->name('google.redirect');
    Route::get('auth/google/callback', [AuthGoogleController::class, 'callback'])
        ->name('google.callback');
});
