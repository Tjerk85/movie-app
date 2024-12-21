<?php

namespace App\Http\Controllers;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\TvShows\GeneralTvShowRequest;
use App\Services\ActorService;
use App\Services\TvShowService;

class TvShowController extends Controller
{
    private TvShowService $tvShowService;
    private ActorService $actorService;
    private int $page;

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

        $rqClass = GeneralTvShowRequest::class;
        return view('tv.index', [
            'popularTvShows' => $this->tvShowService
                ->getMedia(EndPoints::$POPULARTVSHOWSREQUEST, $rqClass, limit: $limit,)
            ['media']->take($limit),
            'onTheAirTvShows' => $this->tvShowService
                ->getMedia(EndPoints::$ONTHEAIRTVSHOWSREQUEST, $rqClass, limit: $limit,)
            ['media']->take($limit),
            'topRatedTvShows' => $this->tvShowService
                ->getMedia(EndPoints::$TOPRATEDTVSHOWSREQUEST, $rqClass, limit: $limit,)
            ['media']->take($limit),
        ]);
    }

    /**
     * Display the TvShow.
     */
    public function showTvShow(int $id)
    {
        $rqClass = GeneralTvShowRequest::class;
        return view('tv.show', [
            'tvShow' => $this->tvShowService->getSingleMedium($id, $rqClass, EndPoints::$TVSHOWREQUEST),
            'similarTvShows' => $this->tvShowService->getSimilar($id, $rqClass, EndPoints::$SIMILARTVSHOWSREQUEST),
            'actors' => $this->actorService->getActorRelatedToTvShow($id, 5),
            'itemsToShow' => 8,
        ]);
    }

    /**
     * Display a listing of on the air tv shows.
     */
    public function onTheAirTvShows()
    {
        $request = $this->tvShowService
            ->getMedia(EndPoints::$ONTHEAIRTVSHOWSREQUEST, GeneralTvShowRequest::class, $this->page);

        return view('tv.tvShows', [
            'tvShows' => $request['media'],
            'paginator' => $request['paginator'],
            'title' => 'Shows on the air',
        ]);
    }

    /**
     * Display a listing of trending movies.
     */
    public function popularTvShows(string $when = 'day')
    {
        $request = $this->tvShowService
            ->getMedia(EndPoints::$POPULARTVSHOWSREQUEST, GeneralTvShowRequest::class, $this->page);

        return view('tv.tvShows', [
            'tvShows' => $request['media'],
            'paginator' => $request['paginator'],
            'title' => 'Popular TV shows',
        ]);
    }

    /**
     * Display a listing of top-rated tv shows.
     */
    public function topRatedTvShows()
    {
        $request = $this->tvShowService
            ->getMedia(EndPoints::$TOPRATEDTVSHOWSREQUEST, GeneralTvShowRequest::class, $this->page,);

        return view('tv.tvShows', [
            'tvShows' => $request['media'],
            'paginator' => $request['paginator'],
            'title' => 'Top rated TV Shows',
        ]);
    }
}
