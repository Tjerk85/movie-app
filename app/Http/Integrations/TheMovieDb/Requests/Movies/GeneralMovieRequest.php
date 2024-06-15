<?php

namespace App\Http\Integrations\TheMovieDb\Requests\Movies;

use App\Models\Movie;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Integrations\TheMovieDb\EndPoints;

class GeneralMovieRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $endPoint,
        protected readonly string $jsonResultKey = '',
    )
    {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return $this->endPoint;
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse($response): Movie|Collection
    {
        if ($this->jsonResultKey) {
            return Movie::createMovieObject(collect($response->json($this->jsonResultKey)));
        }

        return Movie::createMovieObject($response->json());
    }
}
