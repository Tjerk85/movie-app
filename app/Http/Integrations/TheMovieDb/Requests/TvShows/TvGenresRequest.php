<?php

namespace App\Http\Integrations\TheMovieDb\Requests\TvShows;

use App\Models\Genre;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Illuminate\Support\Collection;

class TvGenresRequest extends Request
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
        return '/genre/tv/list?language=en';
    }

    public function createDtoFromResponse(Response $response): Collection
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
