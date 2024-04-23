<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forgot-password/{token}', function (string $token) {
    return view('auth.forgot-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/forgot-password', [AuthController::class,'forgotPassword']);



