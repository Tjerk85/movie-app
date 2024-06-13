<?php

namespace App\Http\Integrations\themoviedb\Requests;

use App\Models\Movie;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class MovieRequest extends Request
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
        return "/movie/{$this->movieId}";
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse($response): Movie
    {
        return Movie::createMovieObject($response->json());
    }
}
