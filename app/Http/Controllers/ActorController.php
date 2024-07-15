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

    public function index()
    {
        return view('actors.index', [
            'popularActors' => '',
        ]);
    }

    public function showActor($id)
    {
        return view('actors.show', [
            'actor' => $this->actorService->getActor($id),
        ]);
    }
}
