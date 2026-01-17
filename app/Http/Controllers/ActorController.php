<?php

namespace App\Http\Controllers;

use App\Services\ActorService;
use Illuminate\Http\Request;

class ActorController extends Controller
{
    private ActorService $actorService;

    private mixed $page;

    public function __construct()
    {
        $this->actorService = new ActorService();
        $this->page = request()->query->get('page', 1);
    }

    public function index(Request $request)
    {
        $limit = 8;
        $when = $request->input('trending') ?? 'day';

        return view('actors.index', [
            'trendingActors' => $this->actorService->getTrendingActors($when)['actors']->take($limit),
            'popularActors' => $this->actorService->getPopularActors($limit)['actors']->take($limit),
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

    public function trendingActors(Request $request)
    {
        $when = $request->input('trending', 'day');
        $actorsRequest = $this->actorService->getTrendingActors($when, 1, $this->page);

        return view('actors.trending', [
            'actors' => $actorsRequest['actors'],
            'paginator' => $actorsRequest['paginator'],
            'title' => 'Trending Actors',
        ]);
    }
    
    public function pupularActors() 
    {
        $actorsRequest = $this->actorService->getPopularActors(1, $this->page);
        
        return view('actors.popular', [
            'actors' => $actorsRequest['actors'],
            'paginator' => $actorsRequest['paginator'],
            'title' => 'Pupular Actors',
        ]);
    }
}
