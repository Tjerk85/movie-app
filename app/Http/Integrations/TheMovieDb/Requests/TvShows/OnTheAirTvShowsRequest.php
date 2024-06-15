<?php

namespace App\Http\Integrations\TheMovieDb\Requests\TvShows;

use App\Models\Movie;
use App\Models\TvShow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Collection;

class OnTheAirTvShowsRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return '/tv/on_the_air?language=en-US';
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): Movie|Collection
    {
        return TvShow::createTvShowObject(collect($response->json('results')));
    }
}
