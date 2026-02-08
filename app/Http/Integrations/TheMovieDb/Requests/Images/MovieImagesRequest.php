<?php

namespace App\Http\Integrations\TheMovieDb\Requests\Images;

use App\Models\Images;
use Saloon\Enums\Method;
use Saloon\Http\Request;

class MovieImagesRequest extends Request
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
    public function createDtoFromResponse($response): Images|null
    {
        return Images::createMovieObject($response->json());
    }
}
