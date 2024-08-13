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

    private mixed $page;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
        $this->movieService = new MovieService();
        $this->page = request()->query->get('page', 1);
    }

    /**
     * Display a listing of the resource {Trending, Popular, TopRated}
     */
    public function index(Request $request)
    {
        $limit = 4;
        $when = $request->input('trending') ?? 'day';

        return view('movies.index', [
            'trendingMovies' => $this->movieService->getTrending($when, $limit)['movies']->take($limit),
            'popularMovies' => $this->movieService->getPopular($limit)['movies']->take($limit),
            'topRatedMovies' => $this->movieService->getTopRated($limit),
        ]);
    }

    /**
     * Display the movie.
     */
    public function showMovie(int $id)
    {
        return view('movies.show', [
            'movie' => $this->movieService->getMovie($id),
            'similarMovies' => $this->movieService->getSimilar($id),
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
        $request = $this->movieService->getTopRated(1, $this->page);

        return view('movies.movies', [
            'movies' => $request['movies'],
            'paginator' => $request['paginator'],
            'title' => 'Top Rated Movies',
        ]);
    }

    /**
     * Display a listing of trending movies.
     */
    public function trendingMovies(string $when = 'day')
    {
        $request = $this->movieService->getTrending($when, 1, $this->page);

        return view('movies.trending', [
            'movies' => $request['movies'],
            'paginator' => $request['paginator'],
            'title' => 'Trending Movies',
        ]);
    }

    /**
     * Display a listing of Popular movies.
     */
    public function popularMovies()
    {
        $request = $this->movieService->getPopular(1, $this->page);

        return view('movies.movies', [
            'movies' => $request['movies'],
            'paginator' => $request['paginator'],
            'title' => 'Popular Movies',
        ]);
    }
}
