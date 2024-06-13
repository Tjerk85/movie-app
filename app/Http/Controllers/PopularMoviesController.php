<?php

namespace App\Http\Controllers;

use App\Http\Integrations\themoviedb\TheMovieDbConnector;
use App\Http\Integrations\themoviedb\Requests\PopularMoviesRequest;

class PopularMoviesController extends Controller
{
    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
    }

    /**
     * Display a listing of the resource Popular movies.
     */
    public function index()
    {
        return view('movies.movies', [
            'movies' => $this->connector->send(new PopularMoviesRequest())->dto(),
            'title'  => 'Popular Movies',
        ]);
    }
}
