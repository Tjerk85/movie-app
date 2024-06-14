<?php

namespace App\Http\Integrations\TheMovieDb\Requests;

use App\Models\Movie;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Collection;

class SimilarMoviesRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(protected readonly int $movieId)
    {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/movie/{$this->movieId}/similar?language=en-US&page=1";
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): Movie|Collection
    {
        return Movie::createMovieObject(collect($response->json('results')));
    }
}
