<?php

namespace App\Http\Integrations\TheMovieDb\Requests;

use App\Models\Genre;
use Illuminate\Support\Collection;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;

class GenresRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    public function __construct(public readonly string $endPoint) {}

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return $this->endPoint;
    }

    public function createDtoFromResponse(Response $response): Genre|Collection
    {
        $genres = [];
        $data = $response->json('genres');

        foreach ($data as $genre) {
            $genres[] = new Genre(
                id: $genre['id'],
                name: $genre['name'],
            );
        }

        return collect($genres);
    }
}
