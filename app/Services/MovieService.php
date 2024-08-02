<?php

namespace App\Services;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\Actors\ActorRequest;
use App\Http\Integrations\TheMovieDb\Requests\Movies\GeneralMovieRequest;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use Illuminate\Support\Collection;
use Saloon\PaginationPlugin\PagedPaginator;
use function PHPUnit\Framework\isEmpty;

class MovieService
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

    public function getPopular($limit = 1, $page = 1)
    {
        $results = $this->connector
            ->paginate(new GeneralMovieRequest(
                $this->endPoints
                    ->set($this->endPoints::$POPULARMOVIEREQUEST, '')
                    ->getPage()
                    ->getEndPoint(),
                'results'
            ));

        return [
            'movies' => $results
                ->setStartPage($page)
                ->collect(false)
                ->take($limit)
                ->first()
                ->dto(),
            'paginator' => $this->getPagination($results, $page),
        ];
    }

    public function getSimilar($id)
    {
        $results = $this->connector
            ->send(new GeneralMovieRequest(
                $this->endPoints
                    ->set($this->endPoints::$SIMILARMOVIEREQUEST, $id)
                    ->getEndPoint(),
                'results'
            ))
            ->dto();

        return isEmpty($results) ? $results : $results->take(8);
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

    public function getActorsMovie($id, $limit = null)
    {
        return $this->connector
            ->send(new ActorRequest(
                $this->endPoints
                    ->set($this->endPoints::$ACTORSMOVIEREQUEST, $id)
                    ->getEndPoint(),
                'cast'
            ))
            ->dto()
            ->take($limit);
    }

    public function getPagination(PagedPaginator $results, $page): array
    {
        $currentPage = $results->getCurrentPage() + 1;
        return [
            'previousPage' => $currentPage > 1 ? $currentPage - 1 : null,
            'nextPage' => $currentPage === 1 || !($page >= 500) ? $currentPage + 1 : null,
        ];
    }
}
