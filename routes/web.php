<?php

use App\Http\Controllers\UsersController;
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

Route::get('/user', [UsersController::class, 'index'])->name('home');

Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('edit');

Route::get('/users', [UsersController::class, 'user'])->name('new.user');

Route::get('/get-user', [UsersController::class, 'getUser'])->name('get.user');

Route::get('/add', [UsersController::class, 'add']);


