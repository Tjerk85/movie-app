<?php

namespace App\Http\Controllers;

use App\Http\Integrations\themoviedb\TheMovieDbConnector;
use App\Http\Integrations\themoviedb\Requests\MovieRequest;
use App\Http\Integrations\themoviedb\Requests\GenresRequest;
use App\Http\Integrations\themoviedb\Requests\PopularMoviesRequest;
use App\Http\Integrations\themoviedb\Requests\SimilarMoviesRequest;
use App\Http\Integrations\themoviedb\Requests\TrendingMoviesRequest;
use App\Http\Integrations\themoviedb\Requests\TopRatedMoviesRequest;
use App\Http\Integrations\themoviedb\Requests\ServicesToWatchRequest;

class GeneralController extends Controller
{

    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
    }

    /**
     * Display a listing of the resource {Trending, Popular, TopRated}
     */
    public function index(?string $when = 'day')
    {
        $limit = 4;

        return view('movies.index', [
            'trendingMovies' => $this->connector->send(new TrendingMoviesRequest($when))->dto()->take($limit),
            'popularMovies'  => $this->connector->send(new PopularMoviesRequest())->dto()->take($limit),
            'topRatedMovies' => $this->connector->send(new TopRatedMoviesRequest())->dto()->take($limit),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('movies.show', [
            'movie'             => $this->connector->send(new MovieRequest($id))->dto(),
            'similarMovies'     => $this->connector->send(new SimilarMoviesRequest($id))->dto()->take(8),
            'servicesForMovies' => collect($this->connector->send(new ServicesToWatchRequest($id))->json('results')),
            'itemsToShow'       => 8,
        ]);
    }
}
