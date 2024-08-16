<?php

namespace App\Http\Integrations\TheMovieDb;

use Saloon\Contracts\Sender;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Http\Connector;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Http\Senders\GuzzleSender;
use Saloon\PaginationPlugin\Contracts\HasPagination;
use Saloon\PaginationPlugin\PagedPaginator;
use Saloon\Traits\Plugins\AcceptsJson;

class TheMovieDbConnector extends Connector implements HasPagination
{
    use AcceptsJson;

    protected function defaultSender(): Sender
    {
        return resolve(GuzzleSender::class);
    }

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

    public function paginate(Request $request): PagedPaginator
    {
        return new class(connector: $this, request: $request) extends PagedPaginator
        {
            protected function isLastPage(Response $response): bool
            {
                return $response->json('total_pages');
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->json('results');
            }

            protected function getTotalPages(Response $response): int
            {
                return $response->json('total_pages');
            }
        };
    }
}
