<?php

namespace App\Http\Integrations\TheMovieDb\Requests;

use App\Models\Actor;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class ActorRequest extends Request
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
    public function createDtoFromResponse($response): Actor|Collection|null
    {
        if ($this->jsonResultKey) {
            if ($response->json('total_results') === 0) {
                return null;
            }

            return Actor::createActorObject(collect($response->json($this->jsonResultKey)));
        }

        return Actor::createActorObject($response->json());
    }

}
