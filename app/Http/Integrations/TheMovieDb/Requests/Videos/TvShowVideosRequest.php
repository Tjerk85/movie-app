<?php

namespace App\Http\Integrations\TheMovieDb\Requests\Videos;

use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use App\Models\Videos;

class TvShowVideosRequest extends Request 
{
    protected Method $method = Method::GET;

    public function __construct(
        protected readonly string $endPoint,
        protected readonly string $jsonResultKey = 'results',
    ) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return $this->endPoint;
    }

    public function createDtoFromResponse($response): array|null
    {
        return Videos::createVideoArray(collect($response->json($this->jsonResultKey)));
    }
}
