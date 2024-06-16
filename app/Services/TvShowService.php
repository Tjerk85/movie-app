<?php

namespace App\Services;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Http\Integrations\TheMovieDb\Requests\Movies\GeneralMovieRequest;
use App\Http\Integrations\TheMovieDb\Requests\TvShows\GeneralTvShowRequest;
use function PHPUnit\Framework\isEmpty;

class TvShowService
{
    private EndPoints $endPoints;
    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->endPoints = new EndPoints();
        $this->connector = new TheMovieDbConnector();
    }

    public function getOnTheAir($limit = null)
    {
        return $this->connector
            ->send(new GeneralTvShowRequest(
                $this->endPoints
                    ->set($this->endPoints::$ONTHEAIRTVSHOWSREQUEST)
                    ->getEndPoint(),
                'results'
            ))
            ->dto()
            ->take($limit);
    }

    public function getTopRated($limit = null)
    {
        return $this->connector
            ->send(new GeneralTvShowRequest(
                $this->endPoints
                    ->set($this->endPoints::$TOPRATEDTVSHOWSREQUEST)
                    ->getEndPoint(),
                'results'
            ))
            ->dto()
            ->take($limit);
    }

    public function getPopular($limit = null)
    {
        return $this->connector
            ->send(new GeneralTvShowRequest(
                $this->endPoints
                    ->set($this->endPoints::$POPULARTVSHOWSREQUEST)
                    ->getEndPoint(),
                'results'
            ))
            ->dto()
            ->take($limit);
    }

    public function getSimilar($id)
    {
        $results = $this->connector
            ->send(new GeneralTvShowRequest(
                $this->endPoints
                    ->set($this->endPoints::$SIMILARTVSHOWSREQUEST, $id)
                    ->getEndPoint(),
                'results'
            ))
            ->dto();

        return isEmpty($results) ? $results : $results->take(8);
    }

    public function getTvShow($id)
    {
        return $this->connector
            ->send(new GeneralTvShowRequest(
                $this->endPoints
                    ->set($this->endPoints::$TVSHOWREQUEST, $id)
                    ->getEndPoint()
            ))
            ->dto();
    }
}
