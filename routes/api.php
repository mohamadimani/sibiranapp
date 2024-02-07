<?php

use App\Http\Controllers\CrewController;
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

Route::get('movies', [MovieController::class, 'index'])->name('movie.index');
Route::get('movies/{movie}', [MovieController::class, 'show'])->name('movie.show');

Route::post('movies', [MovieController::class, 'store'])->name('movie.store');
Route::patch('movies/{movie}', [MovieController::class, 'update'])->name('movie.update');

Route::delete('movies/{movie}', [MovieController::class, 'destroy'])->name('movie.destroy');



Route::get('crews', [CrewController::class, 'index'])->name('crew.index');
Route::get('crews/{crew}', [CrewController::class, 'show'])->name('crew.show');

Route::post('crews', [CrewController::class, 'store'])->name('crew.store');
Route::patch('crews/{crew}', [CrewController::class, 'update'])->name('crew.update');

Route::delete('crews/{crew}', [CrewController::class, 'destroy'])->name('crew.destroy');
