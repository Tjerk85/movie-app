<?php

namespace App\Http\Integrations\themoviedb\Requests;

use App\Models\Movie;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Collection;

class TrendingMoviesRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * $when parameter can be {day} or {week}
     */
    public function __construct(protected readonly string $when)
    {
    }

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/trending/movie/{$this->when}?language=en-US";
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): Movie|Collection
    {
        return Movie::createMovieObject(collect($response->json('results')));
    }
}
