<?php

namespace App\Http\Controllers;

use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Services\ActorService;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    private TheMovieDbConnector $connector;

    private ActorService $actorService;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
        $this->actorService = new ActorService();
    }

    public function index(Request $request)
    {
        $limit = 12;
        $when = $request->input('trending') ?? 'day';

        return view('actors.index', [
            'trendingActors' => $this->actorService->getTrendingActors($when, $limit),
            'popularActors' => $this->actorService->getPopularActors($limit),
            'itemsToShow' => $limit
        ]);
    }

    public function showActor($id)
    {
        return view('actors.show', [
            'actor' => $actor = $this->actorService->getActor($id),
            'moviesRelatedToActor' => $this->actorService->getMoviesRelatedToActor($actor->movie_credits),
            'tvShowRelatedToActor' => $this->actorService->getTvShowRelatedToActor($actor->tv_credits),
        ]);
    }
}
