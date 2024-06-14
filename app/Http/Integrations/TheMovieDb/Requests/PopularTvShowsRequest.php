<?php

namespace App\Http\Integrations\TheMovieDb\Requests;

use App\Models\TvShow;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Collection;

class PopularTvShowsRequest extends Request
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
        return '/tv/popular?language=en-US&page=1';
    }

    /**
     * @throws \JsonException
     */
    public function createDtoFromResponse(Response $response): TvShow|Collection
    {
        return TvShow::createTvShowObject(collect($response->json('results')));
    }
}
