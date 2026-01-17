<?php

use App\Http\Controllers\DiscoverWithGenresController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TvShowController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActorController;

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
Route::get('/actors/actor/{id}', [ActorController::class, 'showActor'])->name('showActor');
Route::get('/actors', [ActorController::class, 'index'])->name('actors');
Route::get('/actors/trending', [ActorController::class, 'trendingActors'])->name('trendingActors');
Route::get('/actors/popular', [ActorController::class, 'pupularActors'])->name('pupularActors');

// Search movies, tv shows and actors
Route::post('/search', [SearchController::class, 'search'])->name('search');

// Genre
Route::get('/genre/{typeOfMedia}/{genreName}/{genreId}', [DiscoverWithGenresController::class, 'byGenre'])->name('genre');
Route::get('/genre/{typeOfMedia}', [DiscoverWithGenresController::class, 'index'])->name('index');
