<?php

namespace App\Services;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\TvShows\GeneralTvShowRequest;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;

use function PHPUnit\Framework\isEmpty;

class TvShowService
{
    private EndPoints $endPoints;

    private TheMovieDbConnector $connector;

    private GeneralService $generalService;

    public function __construct()
    {
        $this->endPoints = new EndPoints();
        $this->connector = new TheMovieDbConnector();
        $this->generalService = new GeneralService();
    }

    public function getOnTheAir($limit = 1, $page = 1)
    {
        $results = $this->connector
            ->paginate(new GeneralTvShowRequest(
                $this->endPoints
                    ->set($this->endPoints::$ONTHEAIRTVSHOWSREQUEST)
                    ->getEndPoint(),
                'results'
            ));

        return [
            'tvShows' => $results
                ->setStartPage($page)
                ->collect(false)
                ->take($limit)
                ->first()
                ->dto(),
            'paginator' => $this
                ->generalService
                ->getPagination($results, $page),
        ];
    }

    public function getTopRated($limit = 1, $page = 1)
    {
        $results = $this->connector
            ->paginate(new GeneralTvShowRequest(
                $this->endPoints
                    ->set($this->endPoints::$TOPRATEDTVSHOWSREQUEST)
                    ->getEndPoint(),
                'results'
            ));

        return [
            'tvShows' => $results
                ->setStartPage($page)
                ->collect(false)
                ->take($limit)
                ->first()
                ->dto(),
            'paginator' => $this
                ->generalService
                ->getPagination($results, $page),
        ];
    }

    public function getPopular($limit = 1, $page = 1)
    {
        $results = $this->connector
            ->paginate(new GeneralTvShowRequest(
                $this->endPoints
                    ->set($this->endPoints::$POPULARTVSHOWSREQUEST)
                    ->getEndPoint(),
                'results'
            ));

        return [
            'tvShows' => $results
                ->setStartPage($page)
                ->collect(false)
                ->take($limit)
                ->first()
                ->dto(),
            'paginator' => $this
                ->generalService
                ->getPagination($results, $page),
        ];
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
