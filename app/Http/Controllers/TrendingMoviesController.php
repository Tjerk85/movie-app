<?php

namespace App\Http\Controllers;

use App\Http\Integrations\themoviedb\TheMovieDbConnector;
use App\Http\Integrations\themoviedb\Requests\TrendingMoviesRequest;

class TrendingMoviesController extends Controller
{
    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $title = 'day')
    {
        return view('movies.trending', [
            'movies' => $this->connector->send(new TrendingMoviesRequest($title))->dto(),
            'title'  => 'Trending Movies',
        ]);
    }
}
