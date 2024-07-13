<?php

namespace App\Http\Integrations\TheMovieDb\Requests\Movies;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class ServicesToWatchRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(protected readonly int $movieId) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return "/movie/{$this->movieId}/watch/providers";
    }
}
