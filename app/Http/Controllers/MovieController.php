<?php

namespace App\Http\Controllers;

use App\Http\Integrations\TheMovieDb\Requests\Movies\ServicesToWatchRequest;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private TheMovieDbConnector $connector;

    private MovieService $movieService;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
        $this->movieService = new MovieService();
    }

    /**
     * Display a listing of the resource {Trending, Popular, TopRated}
     */
    public function index(Request $request)
    {
        $limit = 4;
        $when = $request->input('trending') ?? 'day';

        return view('movies.index', [
            'trendingMovies' => $this->movieService->getTrending($when, $limit),
            'popularMovies' => $this->movieService->getPopular($limit),
            'topRatedMovies' => $this->movieService->getTopRated($limit),
        ]);
    }

    /**
     * Display the movie.
     */
    public function showMovie(int $id)
    {
        return view('movies.show', [
            'movie'             => $this->movieService->getMovie($id),
            'similarMovies'     => $this->movieService->getSimilar($id),
            'servicesForMovies' => collect($this->connector
                ->send(new ServicesToWatchRequest($id))
                ->json('results')),
            'actors' => $this->movieService->getActorsMovie($id, 5),
            'itemsToShow' => 8,
        ]);
    }

    /**
     * Display a listing of top-rated movies.
     */
    public function topRatedMovies()
    {
        return view('movies.movies', [
            'movies' => $this->movieService->getTopRated(),
            'title' => 'Top Rated Movies',
        ]);
    }

    /**
     * Display a listing of trending movies.
     */
    public function trendingMovies(string $when = 'day')
    {
        return view('movies.trending', [
            'movies' => $this->movieService->getTrending($when),
            'title' => 'Trending Movies',
        ]);
    }

    /**
     * Display a listing of Popular movies.
     */
    public function popularMovies()
    {
        return view('movies.movies', [
            'movies' => $this->movieService->getPopular(),
            'title' => 'Popular Movies',
        ]);
    }
}
