<?php

namespace App\Http\Controllers;

use App\Http\Integrations\themoviedb\TheMovieDbConnector;
use App\Http\Integrations\themoviedb\Requests\TopRatedMoviesRequest;

class TopRatedMoviesController extends Controller
{
    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('movies.movies', [
            'movies' => $this->connector->send(new TopRatedMoviesRequest())->dto(),
            'title'  => 'Top Rated Movies',
        ]);
    }
}
