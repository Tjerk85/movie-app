<?php

namespace App\Http\Integrations\TheMovieDb\Requests\TvShows;

use App\Models\TvShow;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\PaginationPlugin\Contracts\Paginatable;

class GeneralTvShowRequest extends Request implements Paginatable
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $endPoint,
        protected readonly string $jsonResultKey = '',
    ) {}

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
    public function createDtoFromResponse($response): TvShow|Collection|null
    {
        if ($this->jsonResultKey) {
            if ($response->json('total_results') === 0) {
                return null;
            }

            return TvShow::createTvShowObject(collect($response->json($this->jsonResultKey)));
        }

        return TvShow::createTvShowObject($response->json());
    }
}
