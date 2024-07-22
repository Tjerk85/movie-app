<?php

namespace App\Services;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\Actors\ActorRequest;
use App\Http\Integrations\TheMovieDb\Requests\Actors\ActorSingleRequest;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Models\Movie;
use App\Models\TvShow;

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

    public function getMoviesRelatedToActor($movieCredits)
    {
        return Movie::createMovieObject(collect($movieCredits))
            ->sortBy('vote_average')
            ->reverse();
    }

    public function getTvShowRelatedToActor($tvShowCredits)
    {
        return TvShow::createTvShowObject(collect($tvShowCredits))
            ->sortBy('vote_average')
            ->reverse();
    }

    public function getActorRelatedToTvShow($id, $limit = null)
    {
        $results = $this->connector
            ->send(new ActorRequest(
                $this->endPoints
                    ->set($this->endPoints::$ACTORSRELATEDTOTVSHOWREQUEST, $id)
                    ->getEndPoint(),
                'cast'
            ))
            ->dto();

        if ($results instanceof \App\Models\ActorMovie) {
            return $results;
        }

        return is_null($results) ? null : $results->take($limit);
    }

    public function getPopularActors($limit = 12)
    {
        return $this->connector
            ->send(new ActorRequest(
                $this->endPoints
                    ->set($this->endPoints::$POPULARACTORREQUEST)
                    ->getEndPoint(),
                'results'
            ))->dto()
            ->take($limit);
    }

    public function getTrendingActors($when = 'day', $limit = 12)
    {
        return $this->connector
            ->send(new ActorRequest(
                $this->endPoints
                    ->set($this->endPoints::$TRENDINGACTORREQUEST, $when)
                    ->getEndPoint(),
                'results'
            ))->dto()
            ->take($limit);
    }
}
