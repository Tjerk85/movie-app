<?php

namespace App\Services;

use App\Http\Integrations\TheMovieDb\EndPoints;
use App\Http\Integrations\TheMovieDb\Requests\GenresRequest;
use App\Http\Integrations\TheMovieDb\TheMovieDbConnector;
use Illuminate\Support\Collection;

class GenreService
{
    private TheMovieDbConnector $connector;
    private EndPoints $endPoint;

    public function __construct()
    {
        $this->connector = new TheMovieDbConnector();
        $this->endPoint = new EndPoints();
    }

    public function getGenres(string $mediaType): Collection
    {
        /** @var Collection $genres */
        $genres = $this->connector->send(new GenresRequest(
            $this->endPoint
                ->set($this->endPoint::$GENREREQUEST, [$mediaType])
                ->getEndPoint()
        ))->dto();

        return $genres;
    }
}
