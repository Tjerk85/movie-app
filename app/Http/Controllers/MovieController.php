<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Http\Integrations\TheMovieDb\Requests\Movies\GeneralMovieRequest;
use App\Http\Integrations\TheMovieDb\Requests\Movies\ServicesToWatchRequest;

class MovieController extends Controller
{

    private TheMovieDbConnector $connector;
    private EndPoints $endPoints;
    private $topRated;
    private $trending;
    private $popular;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
        $this->endPoints = new EndPoints();

        $this->topRated = $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints->set($this->endPoints::$TOPRATEDMOVIEREQUEST)
                    ->getEndPoint(),
                'results'
            ));

        $this->trending = $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints->set($this->endPoints::$TRENDINGMOVIEREQUEST, $when)
                    ->getEndPoint(),
                'results'
            ));

        $this->popular = $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints->set($this->endPoints::$POPULARMOVIEREQUEST)
                    ->getEndPoint(),
                'results'
            ));
    }

    /**
     * Display a listing of the resource {Trending, Popular, TopRated}
     */
    public function index(Request $request)
    {
        $limit = 4;

        return view('movies.index', [
            'trendingMovies' => $this->trending->dto()->take($limit),
            'popularMovies'  => $this->popular->dto()->take($limit),
            'topRatedMovies' => $this->topRated->dto()->take($limit),
        ]);
    }

    /**
     * Display the movie.
     */
    public function showMovie(int $id)
    {
        return view('movies.show', [
            'movie'             =>
                $this->connector->send(new GeneralMovieRequest(
                    $this->endPoints->set($this->endPoints::$MOVIEREQUEST, $id)
                        ->getEndPoint()
                ))->dto(),
            'similarMovies'     =>
                $this->connector->send(new GeneralMovieRequest(
                    $this->endPoints->set($this->endPoints::$SIMILARMOVIEREQUEST, $id)
                        ->getEndPoint(),
                    'results'
                ))->dto()
                    ->take(8),
            'servicesForMovies' =>
                collect($this->connector
                    ->send(new ServicesToWatchRequest($id))
                    ->json('results')),
            'itemsToShow'       => 8,
        ]);
    }

    /**
     * Display a listing of top-rated movies.
     */
    public function topRatedMovies()
    {
        return view('movies.movies', [
            'movies' => $this->topRated->dto(),
            'title'  => 'Top Rated Movies',
        ]);
    }

    /**
     * Display a listing of trending movies.
     */
    public function trendingMovies(string $when = 'day')
    {
        return view('movies.trending', [
            'movies' => $this->trending->dto(),
            'title'  => 'Trending Movies',
        ]);
    }

    /**
     * Display a listing of Popular movies.
     */
    public function popularMovies()
    {
        return view('movies.movies', [
            'movies' => $this->popular->dto(),
            'title'  => 'Popular Movies',
        ]);
    }
}
