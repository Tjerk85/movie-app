<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvShowController;
use Illuminate\Support\Facades\Route;

// Movie
Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/show/{movieId}', [MovieController::class, 'showMovie'])->name('showMovie');
Route::get('/movies/trending/{when?}', [MovieController::class, 'trendingMovies'])->name('trendingMovies');
Route::get('/movies/popular', [MovieController::class, 'popularMovies'])->name('popularMovies');
Route::get('/movies/top-rated', [MovieController::class, 'topRatedMovies'])->name('topRatedMovies');

// TV
Route::get('/tv', [TvShowController::class, 'index'])->name('tv');
Route::get('/tv/show/{tvShowId}', [TvShowController::class, 'showTvShow'])->name('showTvShow');
Route::get('/tv/trending', [TvShowController::class, 'onTheAirTvShows'])->name('onTheAirTvShows');
Route::get('/tv/popular', [TvShowController::class, 'popularTvShows'])->name('popularTvShows');
Route::get('/tv/top-rated', [TvShowController::class, 'topRatedTvShows'])->name('topRatedTvShows');

// Actor
Route::get('/actors/actor/{id}', [\App\Http\Controllers\ActorController::class, 'showActor'])->name('showActor');
Route::get('/actors', [\App\Http\Controllers\ActorController::class, 'index'])->name('actors');
