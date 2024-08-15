<?php

namespace App\Http\Controllers;

use App\Services\ActorService;
use App\Services\TvShowService;

class TvShowController extends Controller
{
    private TvShowService $tvShowService;
    private ActorService $actorService;
    /**
     * @var bool|float|int|mixed|string|null
     */
    private mixed $page;

    public function __construct()
    {
        $this->tvShowService = new TvShowService();
        $this->actorService = new ActorService();
        $this->page = request()->query->get('page', 1);
    }

    /**
     * Display a listing of the resource {Popular, OnTheAir, TopRated}
     */
    public function index()
    {
        $limit = 4;

        return view('tv.index', [
            'popularTvShows' => $this->tvShowService->getPopular($limit)['tvShows']->take($limit),
            'onTheAirTvShows' => $this->tvShowService->getOnTheAir($limit)['tvShows']->take($limit),
            'topRatedTvShows' => $this->tvShowService->getTopRated($limit)['tvShows']->take($limit),
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
        $request = $this->tvShowService->getOnTheAir(1, $this->page);

        return view('tv.tvShows', [
            'tvShows' => $request['tvShows'],
            'paginator' => $request['paginator'],
            'title' => 'Shows on the air',
        ]);
    }

    /**
     * Display a listing of trending movies.
     */
    public function popularTvShows(string $when = 'day')
    {
        $request = $this->tvShowService->getPopular(1, $this->page);

        return view('tv.tvShows', [
            'tvShows' => $request['tvShows'],
            'paginator' => $request['paginator'],
            'title' => 'Popular TV shows',
        ]);
    }

    /**
     * Display a listing of top-rated tv shows.
     */
    public function topRatedTvShows()
    {
        $request = $this->tvShowService->getTopRated(1, $this->page);

        return view('tv.tvShows', [
            'tvShows' => $request['tvShows'],
            'paginator' => $request['paginator'],
            'title' => 'Top rated TV Shows',
        ]);
    }
}
