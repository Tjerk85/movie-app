<?php

namespace App\Http\Controllers;

use App\Services\ActorService;
use App\Services\TvShowService;

class TvShowController extends Controller
{
    private TvShowService $tvShowService;
    private ActorService $actorService;

    public function __construct()
    {
        $this->tvShowService = new TvShowService();
        $this->actorService = new ActorService();
    }

    /**
     * Display a listing of the resource {Popular, OnTheAir, TopRated}
     */
    public function index()
    {
        $limit = 4;

        return view('tv.index', [
            'popularTvShows' => $this->tvShowService->getPopular($limit),
            'onTheAirTvShows' => $this->tvShowService->getOnTheAir($limit),
            'topRatedTvShows' => $this->tvShowService->getTopRated($limit),
        ]);
    }

    /**
     * Display the TvShow.
     */
    public function showTvShow(int $id)
    {
        return view('tv.show', [
            'tvShow' => $this->tvShowService->getTvShow($id),
            'similarTvShows' => $this->tvShowService->getSimilar($id),
            'actors' => $this->actorService->getActorRelatedToTvShow($id, 5),
            'itemsToShow' => 8,
        ]);
    }

    /**
     * Display a listing of on the air tv shows.
     */
    public function onTheAirTvShows()
    {
        return view('tv.tvShows', [
            'tvShows' => $this->tvShowService->getTopRated(),
            'title' => 'Shows on the air',
        ]);
    }

    /**
     * Display a listing of trending movies.
     */
    public function popularTvShows(string $when = 'day')
    {
        return view('tv.tvShows', [
            'tvShows' => $this->tvShowService->getPopular(),
            'title' => 'Popular TV shows',
        ]);
    }

    /**
     * Display a listing of top-rated tv shows.
     */
    public function topRatedTvShows()
    {
        return view('tv.tvShows', [
            'tvShows' => $this->tvShowService->getTopRated(),
            'title' => 'Top rated TV Shows',
        ]);
    }
}
