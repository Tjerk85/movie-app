<?php

namespace App\Http\Integrations\TheMovieDb;

use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class TheMovieDbConnector extends Connector
{
    use AcceptsJson;

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator(config('services.themoviedb.token'));
    }

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.themoviedb.org/3';
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [
            'accept' => 'application/json',
        ];
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
