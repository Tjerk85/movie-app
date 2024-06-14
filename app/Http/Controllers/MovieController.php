<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Http\Integrations\TheMovieDb\Requests\MovieRequest;
use App\Http\Integrations\TheMovieDb\Requests\PopularMoviesRequest;
use App\Http\Integrations\TheMovieDb\Requests\SimilarMoviesRequest;
use App\Http\Integrations\TheMovieDb\Requests\TrendingMoviesRequest;
use App\Http\Integrations\TheMovieDb\Requests\TopRatedMoviesRequest;
use App\Http\Integrations\TheMovieDb\Requests\ServicesToWatchRequest;

class MovieController extends Controller
{

    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
    }

    /**
     * Display a listing of the resource {Trending, Popular, TopRated}
     */
    public function index(Request $request)
    {
        $limit = 4;

        return view('movies.index', [
            'trendingMovies' => $this->connector->send(new TrendingMoviesRequest($request->query('trending', 'day')))->dto()->take($limit),
            'popularMovies'  => $this->connector->send(new PopularMoviesRequest())->dto()->take($limit),
            'topRatedMovies' => $this->connector->send(new TopRatedMoviesRequest())->dto()->take($limit),
        ]);
    }

    /**
     * Display the movie.
     */
    public function showMovie(int $id)
    {
        return view('movies.show', [
            'movie'             => $this->connector->send(new MovieRequest($id))->dto(),
            'similarMovies'     => $this->connector->send(new SimilarMoviesRequest($id))->dto()->take(8),
            'servicesForMovies' => collect($this->connector->send(new ServicesToWatchRequest($id))->json('results')),
            'itemsToShow'       => 8,
        ]);
    }

    /**
     * Display a listing of top-rated movies.
     */
    public function topRatedMovies()
    {
        return view('movies.movies', [
            'movies' => $this->connector->send(new TopRatedMoviesRequest())->dto(),
            'title'  => 'Top Rated Movies',
        ]);
    }

    /**
     * Display a listing of trending movies.
     */
    public function trendingMovies(string $title = 'day')
    {
        return view('movies.trending', [
            'movies' => $this->connector->send(new TrendingMoviesRequest($title))->dto(),
            'title'  => 'Trending Movies',
        ]);
    }

    /**
     * Display a listing of Popular movies.
     */
    public function popularMovies()
    {
        return view('movies.movies', [
            'movies' => $this->connector->send(new PopularMoviesRequest())->dto(),
            'title'  => 'Popular Movies',
        ]);
    }
}
