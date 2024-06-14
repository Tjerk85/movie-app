<?php

namespace App\Http\Controllers;

use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Http\Integrations\TheMovieDb\Requests\TvShowRequest;
use App\Http\Integrations\TheMovieDb\Requests\PopularTvShowsRequest;
use App\Http\Integrations\TheMovieDb\Requests\SimilarMoviesRequest;
use App\Http\Integrations\TheMovieDb\Requests\SimilarTvShowsRequest;
use App\Http\Integrations\TheMovieDb\Requests\OnTheAirTvShowsRequest;
use App\Http\Integrations\TheMovieDb\Requests\TopRatedTvShowsRequest;

class TvShowController extends Controller
{

    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
    }

    public function index()
    {
        $limit = 4;

        return view('tv.index', [
            'popularTvShows'  => $this->connector->send(new PopularTvShowsRequest())->dto()->take($limit),
            'trendingTvShows' => $this->connector->send(new OnTheAirTvShowsRequest())->dto()->take($limit),
            'topRatedTvShows' => $this->connector->send(new TopRatedTvShowsRequest())->dto()->take($limit),
        ]);
    }

    public function showTvShow($tvShowId)
    {
        return view('tv.show', [
            'tvShow'         => $this->connector->send(new TvShowRequest($tvShowId))->dto(),
            'similarTvShows' => $this->connector->send(new SimilarTvShowsRequest($tvShowId))->dto()->take(8),
            'itemsToShow'    => 8,
        ]);
    }

    public function onTheAirTvShows()
    {
        return view('tv.tvShows', [
            'tvShows' => $this->connector->send(new OnTheAirTvShowsRequest())->dto(),
            'title'   => 'Shows on the air',
        ]);
    }

    public function popularTvShows()
    {
        return view('tv.tvShows', [
            'tvShows' => $this->connector->send(new PopularTvShowsRequest())->dto(),
            'title'   => 'Popular TV shows',
        ]);
    }

    public function topRatedTvShows()
    {
        return view('tv.tvShows', [
            'tvShows' => $this->connector->send(new TopRatedTvShowsRequest())->dto(),
            'title'   => 'Top rated TV Shows',
        ]);
    }
}
