<?php

namespace App\Http\Integrations\themoviedb\Requests;

use App\Models\Genre;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GenresRequest extends Request
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
        return '/genre/movie/list';
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        $genres = [];
        $data   = $response->json('genres');

        foreach ($data as $genre) {
            $genres[] = new Genre(
                id: $genre['id'],
                name: $genre['name'],
            );
        }

        return collect($genres);
    }
}
