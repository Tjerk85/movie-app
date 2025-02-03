<?php

namespace App\Http\Controllers;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\Movies\GeneralMovieRequest;
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

        $rqClass = GeneralMovieRequest::class;
        return view('movies.index', [
                'trendingMovies' => $this->movieService
                    ->getMedia(EndPoints::$TRENDINGMOVIEREQUEST, $rqClass, param: $when, limit: $limit)
                ['media']->take($limit),
                'popularMovies' => $this->movieService
                    ->getMedia(EndPoints::$POPULARMOVIEREQUEST, $rqClass, param: $when, limit: $limit)
                ['media']->take($limit),
                'topRatedMovies' => $this->movieService
                    ->getMedia(EndPoints::$TOPRATEDMOVIEREQUEST, $rqClass, param: $when, limit: $limit)
                ['media']->take($limit),
            ]
        );
    }

    /**
     * Display the movie.
     */
    public function showMovie(int $id)
    {
        $rqClass = GeneralMovieRequest::class;
        return view('movies.show', [
            'movie' => $this->movieService->getSingleMedium($id, $rqClass, EndPoints::$MOVIEREQUEST),
            'similarMovies' => $this->movieService->getSimilar($id, $rqClass, EndPoints::$SIMILARMOVIEREQUEST),
            'servicesForMovies' => collect($this->connector->send(new ServicesToWatchRequest($id))->json('results')),
            'actors' => $this->movieService->getActorsMovie($id, 5),
            'itemsToShow' => 8,
        ]);
    }

    /**
     * Display a listing of top-rated movies.
     */
    public function topRatedMovies()
    {
        $request = $this->movieService
            ->getMedia(EndPoints::$TOPRATEDMOVIEREQUEST, GeneralMovieRequest::class, $this->page);

        return view('movies.movies', [
            'movies' => $request['media'],
            'paginator' => $request['paginator'],
            'title' => 'Top Rated Movies',
        ]);
    }

    /**
     * Display a listing of trending movies.
     */
    public function trendingMovies(string $when = 'day')
    {
        $request = $this->movieService
            ->getMedia(EndPoints::$TRENDINGMOVIEREQUEST, GeneralMovieRequest::class, $this->page, $when);

        return view('movies.trending', [
            'movies' => $request['media'],
            'paginator' => $request['paginator'],
            'title' => 'Trending Movies',
        ]);
    }

    /**
     * Display a listing of Popular movies.
     */
    public function popularMovies()
    {
        $request = $this->movieService
            ->getMedia(EndPoints::$POPULARMOVIEREQUEST, GeneralMovieRequest::class, $this->page);

        return view('movies.movies', [
            'movies' => $request['media'],
            'paginator' => $request['paginator'],
            'title' => 'Popular Movies',
        ]);
    }
}
