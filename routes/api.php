<?php

use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('index', [MovieController::class, 'index'])->name('movie.index');

Route::post('movies', [MovieController::class, 'store'])->name('movie.store');
Route::patch('movies/{movie}/update', [MovieController::class, 'update'])->name('movie.update');
