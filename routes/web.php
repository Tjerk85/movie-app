<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/{when?}', [MovieController::class, 'index'])->name('home');
Route::get('/show/{movieId}', [MovieController::class, 'showMovie'])->name('showMovie');
Route::get('/movies/trending/{when?}', [MovieController::class, 'trendingMovies'])->name('trendingMovies');
Route::get('/movies/popular', [MovieController::class, 'popularMovies'])->name('popularMovies');
Route::get('/movies/top-rated', [MovieController::class, 'topRatedMovies'])->name('topRatedMovies');
