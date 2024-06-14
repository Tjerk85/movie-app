<?php

namespace App\Http\Integrations\TheMovieDb\Requests;

use App\Models\TvShow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Collection;

class TopRatedTvShowsRequest extends Request
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
        return '/tv/top_rated?language=en-US';
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): TvShow|Collection
    {
        return TvShow::createTvShowObject(collect($response->json('results')));
    }
}
