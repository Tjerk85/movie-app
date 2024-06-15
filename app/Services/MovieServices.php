<?php

namespace App\Services;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Http\Integrations\TheMovieDb\Requests\Movies\GeneralMovieRequest;

class MovieServices
{
    private EndPoints $endPoints;
    private TheMovieDbConnector $connector;

    public function __construct()
    {
        $this->endPoints = new EndPoints();
        $this->connector = new TheMovieDbConnector();
    }

    public function getTrending(string $when, $limit = null)
    {
        return $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints
                    ->set($this->endPoints::$TRENDINGMOVIEREQUEST, $when)
                    ->getEndPoint(),
                'results'
            ))
            ->dto()
            ->take($limit);
    }

    public function getTopRated($limit = null)
    {
        return $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints
                    ->set($this->endPoints::$TOPRATEDMOVIEREQUEST)
                    ->getEndPoint(),
                'results'
            ))
            ->dto()
            ->take($limit);
    }

    public function getPopular($limit = null)
    {
        return $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints
                    ->set($this->endPoints::$POPULARMOVIEREQUEST)
                    ->getEndPoint(),
                'results'
            ))
            ->dto()
            ->take($limit);
    }

    public function getSimilar($id)
    {
        return $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints
                    ->set($this->endPoints::$SIMILARMOVIEREQUEST, $id)
                    ->getEndPoint(),
                'results'
            ))
            ->dto()
            ->take(8);
    }

    public function getMovie($id)
    {
        return $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints
                    ->set($this->endPoints::$MOVIEREQUEST, $id)
                    ->getEndPoint()
            ))
            ->dto();
    }
}
