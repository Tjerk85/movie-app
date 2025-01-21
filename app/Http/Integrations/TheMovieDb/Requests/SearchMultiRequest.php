<?php

namespace App\Http\Integrations\TheMovieDb\Requests;

use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use App\Models\SearchMulti;

class SearchMultiRequest extends Request
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

    public function createDtoFromResponse(Response $response): SearchMulti|Collection|null
    {
        if ($this->jsonResultKey) {
            if ($response->json('total_results') === 0) {
                return null;
            }

            return SearchMulti::createSearchObject($response->collect($this->jsonResultKey));
        }
    }
}
