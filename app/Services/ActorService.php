<?php

namespace App\Services;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\Actors\ActorSingleRequest;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;

class ActorService
{
    private EndPoints $endPoints;

    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->endPoints = new EndPoints();
        $this->connector = new TheMovieDbConnector();
    }

    public function getActor($id)
    {
        return $this->connector
            ->send(new ActorSingleRequest(
                $this->endPoints
                    ->set($this->endPoints::$ACTORREQUEST, $id)
                    ->getEndPoint()
            ))
            ->dto();
    }
}
