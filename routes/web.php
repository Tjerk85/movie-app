<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\PopularMoviesController;
use App\Http\Controllers\TrendingMoviesController;
use App\Http\Controllers\TopRatedMoviesController;

Route::get('/{when?}', [GeneralController::class, 'index'])->name('home');
Route::get('/show/{movieId}', [GeneralController::class, 'show'])->name('showMovie');
Route::get('/movies/trending/{when?}', [TrendingMoviesController::class, 'index'])->name('trendingMovies');
Route::get('/movies/popular', [PopularMoviesController::class, 'index'])->name('popularMovies');
Route::get('/movies/top-rated', [TopRatedMoviesController::class, 'index'])->name('topRatedMovies');
