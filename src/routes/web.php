<?php

use App\Events\ExampleEvent;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;
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
    return view('login');
})->name('login.form')->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout']);

Route::post('/', [AuthController::class, 'login'])->name('login');

Route::get('/chat', [MessageController::class, 'chat'])->middleware('auth:web')->name('chat');

Route::post('send-message', [MessageController::class, 'sendMessage']);
