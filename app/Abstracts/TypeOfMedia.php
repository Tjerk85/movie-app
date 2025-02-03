<?php

namespace App\Abstracts;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use App\Services\GeneralService;

abstract class TypeOfMedia
{
    public EndPoints $endPoints;
    public TheMovieDbConnector $connector;
    public GeneralService $generalService;

    public function __construct()
    {
        $this->endPoints = new EndPoints();
        $this->connector = new TheMovieDbConnector();
        $this->generalService = new GeneralService();
    }

    public function getMedia($endPoint, string $requestClass, int $page = 1, string $param = '', $limit = 1): array
    {
        $results = $this->connector
            ->paginate(new $requestClass(
                $this->endPoints
                    ->set($endPoint, $param)
                    ->getEndPoint(),
                'results'
            ));

        return [
            'media' => $results
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

    public function getSimilar($id, $requestClass, $endPoint)
    {
        $results = $this->connector
            ->send(new $requestClass(
                $this->endPoints
                    ->set($endPoint, $id)
                    ->getEndPoint(),
                'results'
            ))
            ->dto();

        return empty($results) ? $results : $results->take(8);
    }

    public function getSingleMedium($id, $requestClass, $endpoint)
    {
        return $this->connector
            ->send(new $requestClass(
                $this->endPoints
                    ->set($endpoint, $id)
                    ->getEndPoint()
            ))
            ->dto();
    }
}
